import React from "react";
import { Routes, Route } from "react-router-dom";
import Allaskereso from "../components/Allaskereso";
import Regisztracio from "../components/Regisztracio";

const Contents = () => {
    return(
        <Routes>
            <Route path="/allaskereso" Component={Allaskereso}/>
            <Route path="/regisztracio" Component={Regisztracio}/>
        </Routes>
    );
}
export default Contents;