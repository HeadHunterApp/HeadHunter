import React from "react";
import "../styles/pages/Admin_allasok.css";
import AllasKartya from '../components/AllasKartya';

/*  ----  EZ NEM FOG KELLENI, MERT AZ ALLASKERESES EREDMÉNYÉT FOGJA MEGJELENÍTENI AZ ADMINNÁL,
      CSAK KAP PLUSZ EGY TÖRLÉS GOMBOT 
      SZERKESZTÉS A FEJVADÁSZNAK IS LESZ   -----  */

const AdminAllasok = () => {
  return (
    <div>
        <AllasKartya/>
        <AllasKartya/>
        <AllasKartya/>
    </div>
  );
};

export default AdminAllasok;
