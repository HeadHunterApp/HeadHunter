import '../../../../styles/AllasKeresoKartya.css';
const SzemelyesAdatokRO = ({ adatok }) => {
  return (
    <div>
      <div className="foto-container">
        <h2 className='foto-name'>FÉNYKÉP</h2>
        {adatok.fenykep
          ? (() => {
              const decodedImage =
                "data:image/png;base64," + adatok.fenykep;
                return <>
                  <img className='foto' src={decodedImage} />
                  
                </>
            })()
          : "Nincs fénykép feltöltve."}
      </div>
      <div className="allker-card">
      <h2 className='allker-name'>SZEMÉLYES ADATOK</h2>
      <div>
        <p className='allker-cim'>Név: {adatok.nev}</p>
        <p className='allker-cim'>Email: {adatok.email}</p>
        <p className='allker-cim'>Tel.: {adatok.telefonszam}</p>
        <p className='allker-cim'>FAX: {adatok.fax}</p>
        <p className='allker-cim'>Állampolgárság: {adatok.allampolgarsag}</p>
        <p className='allker-cim'>Születési ideje: {adatok.szul_ido}</p>
        <p className='allker-cim'>Készségek: {adatok.keszseg}</p>
        <p className='allker-cim'>Neme: {adatok.neme}</p>
        <p className='allker-cim'>Cím: {adatok.cim}</p>
      </div>
      <div>
        <p>{adatok.jogositvagy ? "Van jogositvagy" : "Nincs jogositvany"}</p>
      </div>
      </div>
    </div>
  );
};

export default SzemelyesAdatokRO;
