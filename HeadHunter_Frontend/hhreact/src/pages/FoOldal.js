import React from "react";
import "../styles/Fooldal.css";
import MenuKartya from "../components/menu/MenuKartya";

//bejelentkezés nélküli főoldal

export default function Fooldal(){
  return (
      <div className="maincard-container">
        <MenuKartya link="/seeker-info" title='Álláskeresőknek' picture='/pics/fooldal/people-1979261_1280.jpg' />
        <MenuKartya link="/employer-info" title='Munkáltatóknak' picture='/pics/fooldal/laptop-3196481_1280.jpg' />
      </div>
  );
};
