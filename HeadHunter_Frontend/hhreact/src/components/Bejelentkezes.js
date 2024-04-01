import React, { useState, useEffect } from "react";
import useAuthContext from "../contexts/AuthContext"
import '../styles/components/BejelentkezesForm.css';

export default function Bejelentkezes(){
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const {loginReg, errors} = useAuthContext();

    const handleSubmit =async(e) => {
        e.preventDefault();
        const adat = {
            email: email,
            password: password,
            _token: errors.token
        };
        loginReg(adat, "/login");
    };

    return (
        <div className="form-container">
            <h1>Bejelentkezés</h1>
            <form onSubmit={handleSubmit}>
                <div className="bejelentkezes_input">
                    <label htmlFor="email" className="form-label">
                        Email:
                    </label>
                    <input
                        type="email"
                        // value beállítása a state értékére
                        value={email}
                        // state értékének módosítása ha változik a beviteli mező tartalma
                        onChange={(e) => {
                            setEmail(e.target.value);
                        }}
                        className="form-control"
                        id="email"
                        placeholder="email"
                        name="email"
                    />
                </div>
                <div>
                    {errors.email && (
                        <span className="text-danger">{errors.email[0]}</span>
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
                        placeholder="jelszó"
                        name="pwd"
                    />
                    <div>
                        {errors.password && (
                            <span className="text-danger">
                                {errors.password[0]}
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