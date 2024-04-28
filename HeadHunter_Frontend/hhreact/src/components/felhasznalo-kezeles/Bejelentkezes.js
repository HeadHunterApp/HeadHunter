import React, { useState } from "react";
import useAuthContext from "../../contexts/AuthContext";
import { useNavigate } from "react-router-dom";
import "../../styles/Bejelentkezes.css";

export default function Bejelentkezes({ onClose }) {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const { loginReg, errors } = useAuthContext();
  const navigate = useNavigate();
  // const [error, setError] = useState(null);

  const handleSubmit = async (e) => {
    e.preventDefault();

    const adat = {
      email: email,
      password: password,
      /* _token: errors.token, */
    };
    const success = await loginReg(adat, "/login");
    if (success) {
      onClose();
      navigate("/");
    }
  };

  return (
    <div className="form-container">
      <h1 className="form-bejelentkezes">Bejelentkezés</h1>
      <form onSubmit={handleSubmit}>
        {errors && ( // Megjeleníti az error üzenetet, ha az állapotban van hiba
          <div className="text-danger">{errors?.message}</div>
        )}
        <div className="bejelentkezes_input">
          <label htmlFor="email" className="form-label">
            E-mail:
          </label>
          <input
            type="email"
            value={email}
            onChange={(e) => {
              setEmail(e.target.value);
            }}
            className="form-control"
            id="email"
            placeholder="adja meg az e-mail címét"
            name="email"
          />
        </div>
        <div>
          {errors.email && (
            <span className="text-danger">
              {errors.email.map((e, i) => (
                <div key={i}>{e}</div>
              ))}
            </span>
          )}
        </div>
        <div className="bejelentkezes_input">
          <label htmlFor="pwd" className="form-label">
            Jelszó:
          </label>
          <input
            type="password"
            value={password}
            onChange={(e) => {
              setPassword(e.target.value);
            }}
            className="form-control"
            id="pwd"
            placeholder="adja meg a jelszavát"
            name="pwd"
          />
          <div>
            {errors.password && (
              <span className="text-danger">
              {errors.password.map((e, i) => (
                <div key={i}>{e}</div>
              ))}
            </span>
            )}
          </div>
        </div>

        <div>
          <button type="submit" className="bejelentkezes_login">
            Belépés
          </button>
        </div>
      </form>
    </div>
  );
}
