import React from "react";
import "../../styles/info.css";
import VisszaLink from "../../components/menu/VisszaLink";

export default function MunkaltatoInfo(){
  return (
      <>
        <div className="container">
          <h2>Cégünk nem csupán egy átlagos fejvadász cég.</h2>
          <p>Szolgáltatáscsomagunk keretében a toborzással járó feladatokat 
              szinte teljes egészében átvállaljuk - így a kiválasztási folyamat végén már a legkiválóbb jelöltekkel találkozhatnak.</p>
          <p>Kiemelten fontos számunkra, hogy a legmegfelelőbb pályázókat találjuk meg az adott munkára, ezért a jelentkezőkőn túl 
              a teljes adatbázisunkban ellenőrizzük, hogy regisztrált felhasználóink közül melyek teljesítik az adott pozició elvárásként 
              meghatározott feltételeit, és rendelkeznek az esetlegesen előnyként megjelölt tulajdonságokkal.
              Az igazán jó szakembereket nem mindig könnyű megszólítani a hirdetésekkel, ezért elengedhetetlennek tartjuk a munkaerő piac 
              folyamatos monitorozását, és a hirdetések ehhez történő igazítását.</p>
          <p>Professzionális csapatunk célja a legmagasabb színvonalú szolgáltatás nyújtása Ügyfeleink számára.</p>
          <VisszaLink />
        </div>
      </>
  );
};