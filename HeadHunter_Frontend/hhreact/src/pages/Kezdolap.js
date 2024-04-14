import React from "react";
import useAuthContext from "../contexts/AuthContext";

/* bejelentkezett felhasználók kezdőlapja  */

export default function Kezdolap(){
    const { user, getUser } = useAuthContext();

    return (
        <div>
            <h1>Bejelentkezett felhasználó: {user?.nev}</h1>
         
        </div>
    );
}