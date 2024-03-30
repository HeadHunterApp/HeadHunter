import React, { useState } from "react";
import useAuthContext from "../contexts/AuthContext";
import "../styles/components/BejelentkezesForm.css";
const Bejelentkezes = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const { loginReg, errors } = useAuthContext();

  const handleSubmit = async (e) => {
    e.preventDefault();

    //bejelentkezés
    //Összegyűjtjük egyetlen objektumban az űrlap adatokat
    const adat = {
      email: email,
      password: password,
    };

    loginReg(adat, "/login");
  };

  return (
    <div>
      <h1 className="header">Bejelentkezés</h1>
      <form onSubmit={handleSubmit}>
        <div className="bejelentkezes_input">
          <label htmlFor="email">Email:</label>
          <input
            type="email"
            // value beállítása a state értékére
            value={email}
            // state értékének módosítása ha változik a beviteli mező tartalma
            onChange={(e) => {
              setEmail(e.target.value);
            }}
            id="email"
            placeholder="email"
            name="email"
          />
        </div>
        <div>{errors.email && <span>{errors.email[0]}</span>}</div>
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
            id="pwd"
            placeholder="jelszó"
            name="pwd"
          />
          <div>
            {errors.password && (
              <span className="text-danger">{errors.password[0]}</span>
            )}
          </div>
        </div>

        <div className="bejelentkezes_login">
          <button type="submit">Login</button>

          {/*                     <p>
                        Még nincs felhaszálóneve?
                        <Link className="nav-link text-info" to="/regisztracio">
                            Regisztráció
                        </Link>
                    </p> */}
        </div>
      </form>
    </div>
  );
};
export default Bejelentkezes;
