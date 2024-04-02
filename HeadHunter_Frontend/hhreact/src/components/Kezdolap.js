import React from "react";
import useAuthContext from "../contexts/AuthContext";

export default function Kezdolap(){
    const { user, getUser } = useAuthContext();

    return (
        <div>
            <h1>Bejelentkezett felhasználó: {user?.name}</h1>
         
        </div>
    );
}