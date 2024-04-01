import React from "react";
import useAuthContext from "../contexts/AuthContext";

/* bejelentkezett felhasználók kezdőlapja  */

export default function Kezdolap(){
    const { user, getUser } = useAuthContext();

    return (
        <div>
            <h1>Kezdőlap</h1>
            <p>Bejelentkezett felhasználó: {user?.name}</p>
        </div>
    );
}