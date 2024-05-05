import '../../../../styles/AllasKeresoKartya.css';
const SzakmaiTapasztalatRO = ({ key, adatok }) => {
  return (
    <div className="allker-card">
    <h2 className='allker-name'>SZAKMAI TAPASZTALAT</h2>
    <div  key={key}>
      <p className='allker-cim'>Időtartam: {adatok.idotartam} hónap</p>
      <p className='allker-cim'>Kezdés: {adatok.kezdes}</p>
      <p className='allker-cim'>Végzés: {adatok.vegzes}</p>
      <p className='allker-cim'>Cég neve: {adatok.cegnev}</p>
      <p className='allker-cim'>Cég címe: {adatok.ceg_cim}</p>
      <p className='allker-cim'>Terület: {adatok.teruletMegnevezes}</p>
      <p className='allker-cim'>Pozíció: {adatok.pozkod} - {adatok.pozicio}</p>
    </div>
    </div>
  );
};

export default SzakmaiTapasztalatRO;
