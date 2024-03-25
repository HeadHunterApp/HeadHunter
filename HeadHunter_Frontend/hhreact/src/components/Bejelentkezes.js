import React, { useState } from "react";
import  useAuthContext  from "../contexts/AuthContext";

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
        <div className="m-auto" style={{ maxWidth: "400px" }}>
            <h1 className="header">Bejelentkezés</h1>
            <form onSubmit={handleSubmit}>
                <div className="mb-3 mt-3">
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
                <div className="mb-3">
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

               <div className=" text-center">
                    <button type="submit" className="btn btn-primary w-100">
                        Login
                    </button>

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
} 
export default Bejelentkezes;