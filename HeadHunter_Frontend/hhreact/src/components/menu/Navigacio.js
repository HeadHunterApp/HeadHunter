import React, { useState } from "react";
import "../../styles/Navigacio.css";
import NavLink from "../../components/menu/NavLink";

export default function Navigacio() {

/*  ----  LINKEKHEZ A ROUTE MÉG HIÁNYZIK  -----  */


  return (
    <nav>
      <ul>
        <NavLink link="/" title="Kezdőlap" />
       {/*  {!user && (  */}
                <NavLink link="jobs" title="Álláskeresés" />
         {/*   )} */}

      </ul>
    </nav>
  );
}