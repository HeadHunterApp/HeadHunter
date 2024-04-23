import React from "react";
import "../../styles/info.css";
import VisszaLink from "../../components/menu/VisszaLink";

export default function AllaskerInfo(){
  return (
      <>
        <div className="container">
          <h2>Ha állást keresel, a legjobb helyen jársz.</h2>
          <p>Regisztrált felhasználónkként nem csak jelentkezhetsz a neked szimpatikus hirdetésekre, 
              hanem professzionális fejvadász munkatársaink felkeresnek, amennyiben találnak egy számodra megfelelő pozíciót. Jelentkezést követően 
              a teljes álláskeresési folyamatot menedzseljük, így az ezzel kapcsolatos teendőidet átvállaljuk.
          </p>
          <p><strong>A jobb felső sarokban kattints a Regisztráció gombra</strong> - az egy perces regisztrációt követően máris jelentkezhetsz a meghirdetett állásokra. 
              A saját profilodon belül további adatokat adhatsz meg a tudásodra és a tapasztalataidra vonatkozóan, melyek alapján megtalálhatjuk számodra 
              a tökéletes állást. Ezek kitöltését követően lehetőséged lesz a saját önéletrajzod letöltésére is.
          </p>
          <p>Fontosnak tartjuk, hogy olyan állást találjunk számodra, amely összhangban van  a tudásoddal, tapasztalatoddal és ambícióiddal.
          </p>
          <VisszaLink />
        </div>
      </>
  );
};