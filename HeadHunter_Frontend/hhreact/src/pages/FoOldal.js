import React from "react";
import "../styles/Fooldal.css";
import MenuKartya from "../components/menu/MenuKartya";



/*  ----  LINKEKHEZ A ROUTE MÉG HIÁNYZIK  -----  */

const Fooldal = () => {
  return (
      <div className="maincard-container">
        <MenuKartya link="/allaskeresoknek" title='Álláskeresőknek' picture='/pics/fooldal/people-1979261_1280.jpg' />
        <MenuKartya link="/munkaltatoknak" title='Munkáltatóknak' picture='/pics/fooldal/laptop-3196481_1280.jpg' />
      </div>
  );
};

export default Fooldal;
