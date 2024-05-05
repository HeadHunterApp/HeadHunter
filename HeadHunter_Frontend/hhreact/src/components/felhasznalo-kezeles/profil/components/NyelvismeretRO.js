import '../../../../styles/AllasKeresoKartya.css';
const NyelvismeretRO = ({ key, adatok }) => {
  return (
    <div className="allker-card">
    <h2 className='allker-name'>NYELV ISMERET</h2>
    <div  key={key}>
      <div>
        <p className='allker-cim'>Nyelv: {adatok.nyelv}</p>
        <p className='allker-cim'>Szint: {adatok.szint}</p>
        {
          adatok.nyelvvizsga ? 
          (<><p className='allker-cim'>Van nyelvvizsgája</p>
          <p className='allker-cim'>Írás tudás: {adatok.iras}</p>
          <p className='allker-cim'>Olvasás tudás: {adatok.olvasas}</p>
          <p className='allker-cim'>Beszéd tudás: {adatok.beszed}</p></>)
          : "Nincs nyelvvizsgája"
        }
      </div>
    </div>
    </div>
  );
};

export default NyelvismeretRO;
