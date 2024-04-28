import React from "react";
import useAuthContext from "../contexts/AuthContext";
import BejKezdolap from "../components/BejKezdolap";
import Fooldal from "../components/Fooldal";


//kezdőlapokat itt kezeljük le

export default function Kezdolap(){

    const { user } = useAuthContext();
    const belepve = !!user;

    return (
        <>
     {/*    {belepve ? (
            <BejKezdolap />
        ) : ( */}
            <Fooldal />
     {/*    )}  */}
        </>
    );
}