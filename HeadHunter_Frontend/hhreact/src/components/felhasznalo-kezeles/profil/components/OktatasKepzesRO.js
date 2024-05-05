import '../../../../styles/AllasKeresoKartya.css';
const OktatasKepzesRO = ({ key, adatok }) => {
  return (
    <div className="allker-card">
    <h2 className='allker-name'>OKTATÁS ÉS KÉPZÉS</h2>
    <div key={key}>
      <p className='allker-cim'>Időtartam: {adatok.idotartam} hónap</p>
      <p className='allker-cim'>Kezdés: {adatok.kezdes}</p>
      <p className='allker-cim'>Végzés: {adatok.vegzes}</p>
      <p className='allker-cim'>Intézmény: {adatok.intezmeny}</p>
      <p className='allker-cim'>Érintett tárgytevékenység: {adatok.erintett_targytev}</p>
      <p className='allker-cim'>Szak: {adatok.szak}</p>
      <p className='allker-cim'>Végzettség: {adatok.vegzettseg['megnevezes']}</p>
    </div>
    </div>
  );
};

export default OktatasKepzesRO;
