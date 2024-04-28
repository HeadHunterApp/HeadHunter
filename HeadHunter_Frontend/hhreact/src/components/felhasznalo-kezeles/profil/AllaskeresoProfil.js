import React, { useEffect, useState } from "react";
import { getAllaskeresoNyelvtudas, getAllaskeresoTanulmany, getAllaskeresoTapasztalat, getProfilAllaskereso, postFotoFeltolt, putAllaskeresoNyelvtudas, putAllaskeresoTanulmany, putAllaskeresoTapasztalat, putProfilAllaskereso} from '../../../contexts/ProfilContext';
import axios from "../../../api/axios";
import '../../../styles/profil.css';

const AllaskeresoProfil = ({ onSubmit }) => {
     
  const [nev, setNev] = useState("");
  const [email, setEmail] = useState("");
  const [telefonszam, setTelefonszam] = useState("");
  const [fax, setFax] = useState("");
  const [allampolgarsag, setAllampolgarsag] = useState("");
  const [szul_ido, setSzul_ido] = useState('2005-01-01');
  const [jogositvany, setJogositvany] = useState(false);
  const [keszseg, setKeszseg] = useState("");
  const [neme, setNeme] = useState();
  const [idotartam, setIdotartam] = useState(0);
  const [cegnev, setCegnev] = useState("");
  const [terulet, setTerulet] = useState("");
  const [beosztas, setBeosztas] = useState("");
  const [kezdes, setKezdes] = useState(new Date);
  const [vegzes, setVegzes] = useState(new Date);
  const [oktidotartam, setOktIdotartam] = useState(0);
  const [intezmeny, setIntezmeny] = useState("");
  const [fotargy, setFotargy] = useState("")
  const [szakkepesites, setSzakkepesites] = useState("");
  const [oktkeszseg, setOktKeszseg] = useState("");
  const [oktkezdes, setOktKezdes] = useState(new Date);
  const [oktvegzes, setOktVegzes] = useState(new Date);
  const [anyanyelv, setAnyanyelv] = useState("");
  const [nyelvtudas, setNyelvtudas] = useState("");
  const [nyelvvizsga, setNyelvvizsga] = useState(false);
  const [olvasas, setOlvasas] = useState("");
  const [iras, setIras] = useState("");
  const [beszed, setBeszed] = useState("");
  const [cim, setCim] = useState("");

  useEffect(()=>{
    getAllaskeresoNyelvtudas().then((response)=>{
      let nyelv = response.data[0];

      if (nyelv !== null && typeof nyelv !== 'undefined')
      {
          //setAnyanyelv(nyelv.anyanyelv);
          setNyelvvizsga(nyelv.nyelvvizsga);
          setOlvasas(nyelv.olvasas);
          setIras(nyelv.iras);
          setBeszed(nyelv.beszed);
          setNyelvtudas(nyelv.nyelv);
          //setNyelvtudas(nyelv.allaskeresonyelkod.nyelvtudas);
      }
    })
  },[])

  useEffect(()=>{
    getAllaskeresoTanulmany().then((response)=>{

      let tanulmany = response.data[0];

      if (tanulmany !== null && typeof tanulmany !== 'undefined')
      {
        setOktIdotartam(response.idotartam);
        setIntezmeny(response.intezmeny);
        setFotargy(response.erintett_targytev);
        setSzakkepesites(response.szak)
        setKeszseg(response.szoc_keszseg);
      } 
    })
  },[])

  useEffect(()=>{
    getAllaskeresoTapasztalat().then((response)=>{ 

      let tapasztalat = response.data[0];

      if (tapasztalat !== null && typeof tapasztalat !== 'undefined')
      {
          setIdotartam(response.idotartam) ; //backend számolja a végzés és a kezdésből.
          setCegnev(response.allaskeresotapasztalat.cegnev);
          setTerulet(response.terulet);
          setBeosztas(response.allaskeresotapasztalat.pozicio);
          setKezdes(response.allaskeresotapasztalat.kezdes);
          setVegzes(response.allaskeresotapasztalat.vegzes);
      }
    })
  },[])

  useEffect(()=>{
    getProfilAllaskereso().then((response)=>{
      let adat = response.data;

      setNev(adat.nev);
      setEmail(adat.email);
      setTelefonszam(adat.telefonszam);
      setFax(adat.fax) ;
      setAllampolgarsag(adat.allampolgarsag);
      setSzul_ido(adat.szul_ido);
      setJogositvany(adat.jogositvany);
      setKeszseg(adat.keszseg);
      setNeme(adat.neme);
      setCim(adat.cim);
    })
  },[])



    const fenykepFeltoltes = (event) =>{
      event.preventDefault();
      const fajl = event.target.files[0];
      let FormData = new FormData();
      FormData.append(fajl.name, fajl)
      postFotoFeltolt(FormData);//megfelelő routot meg kell adni(írni)!!!
    }
  
    const onSzerkesztes = async()=>{
      let token = "";

      await axios.get("/api/token").then((response) => {
        console.log(response);
        token = response.data;
      });

      const config = {
        headers: {
          'X-CSRF-TOKEN': token
      } };

      putProfilAllaskereso({nev, email, fax, allampolgarsag, szul_ido, jogositvany, keszseg, neme, cim, anyanyelv}, config)
      .then((response)=>{
 
      })
      putAllaskeresoTapasztalat({cegnev, terulet, beosztas, kezdes, vegzes}, config)
      .then((response)=>{

      })
      putAllaskeresoTanulmany({intezmeny, fotargy, szakkepesites, oktkeszseg, oktkezdes, oktvegzes}, config)
      .then((response)=>{

      })
      putAllaskeresoNyelvtudas({nyelvvizsga, olvasas, iras, beszed, nyelvtudas}, config)
      .then((response)=>{
        if(response.status === '200'){
          alert('Módosítás sikersen megtörtént!');
        }
      })
 
    }

    const onGenerealas = ()=>{

    }
    const handleSubmit = (e) => {
      e.preventDefault();
      
      onSzerkesztes();
    };

    return (
      <>
      <div className="lehetoseg">Álláslehetőségek</div>
      <form className="allprofil" onSubmit={handleSubmit}>
       
       <div>
          <label htmlFor="fenykep">Fénykép:</label> 
          <input
            type="file"
            id="fenykep"
            onChange={fenykepFeltoltes}
          />
        </div>
        <div className="temakor">SZEMÉLYES ADATOK:</div> 
        <div>
                 <div>
            <label htmlFor="nev">Vezetéknév/utónév:</label> 
            <input
              type="text"
              id="nev"
              value={nev}
              onChange={(e) => setNev(e.target.value)}
            />
          </div>       
          <div>
          <label htmlFor="telefonszam">Telefonszám:</label>
          <input
            type="text"
            id="telefonszam"
            value={telefonszam}
            onChange={(e) => setTelefonszam(e.target.value)}
          />
        </div>
          <div >
          <label>Fax:</label> 
            <input
              type="text"
              name="fax"
              value={fax}
              onChange={(e)=> setFax(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="email">E-mail:</label> 
            <input
              type="email"
              id="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="cim">Lakcím: :</label> 
            <input
              type="text"
              id="cim"
              value={cim}
              onChange={(e) => setCim(e.target.value)}
            />
          </div>
          <div >
          <label>Állampolgárság:</label>  
            <input
              type="text"
              name="allampolgarsag"
              value={allampolgarsag}
              onChange={(e) => setAllampolgarsag(e.target.value)}
            />
          </div>
          <div >
          <label>Születési idő:</label> 
            <input
              type="date"
              name="szul_ido"
              value={szul_ido}
              onChange={(e)=>setSzul_ido(e.target.value)}
            />
          </div>
          <div>
          <div className="nem">
              <label className="nem-label1"> Férfi</label> 
              <input
                type="radio"
                value="ferfi"
                checked={neme === "ferfi"}
                name="nem"
                onChange={(e)=> setNeme(e.response.value)}
              />
            </div>
            <div className="nem">
              <label className="nem-label">Nő</label> 
              <input
                type="radio"
                value="nő"
                checked={neme === "nő"}
                name="nem"
                onChange={(e)=> setNeme(e.response.value)}
              />
            </div>
          </div>
          <div >
          <label>Vezetői engedély(ek):</label> 
            <input
              type="text"
              name="jogositvany"
              value={jogositvany}
              onChange={(e)=> setJogositvany(e.target.value)}
            />
          </div>
          <div >
          <label>Betölteni kívánt munkakör/foglalkozási terület:</label> 
            <input
              type="text"
              name="szoc_keszseg"
              value={keszseg}
              onChange={(e)=> setKeszseg(e.target.value)}
            />
          </div>
        </div>
       
        <div className="temakor">SZAKMAI TAPASZTALAT</div>
        <div >
        <div>
            <label htmlFor="idotartam">Időtartam:</label> 
            <input
              type="number"
              id="idotartam"
              value={idotartam}
              onChange={(e) => setIdotartam(e.target.value)}
            />
          </div>  
          <div>
            <label htmlFor="kezdes">Időtartam:</label> 
            <input
              type="date"
              id="kezdes"
              value={kezdes}
              onChange={(e) => setKezdes(e.target.value)}
            />
          </div>  
          <div>
            <label htmlFor="vegzes">Időtartam:</label> 
            <input
              type="date"
              id="vegzes"
              value={vegzes}
              onChange={(e) => setVegzes(e.target.value)}
            />
          </div>       
          <div>
          <label htmlFor="cegnev">Munkáltató neve:</label>
          <input
            type="text"
            id="cegnev"
            value={cegnev}
            onChange={(e) => setCegnev(e.target.value)}
          />
        </div>
          <div >
          <label htmlFor="terulet">Tevékenység típusaés ágazata:</label> 
            <input
              type="text"
              name="terulet"
              value={terulet}
              onChange={(e)=> setTerulet(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="pozicio">Foglalkoztatás, beosztás:</label> 
            <input
              type="text"
              id="pozicio"
              value={beosztas}
              onChange={(e) => setBeosztas(e.target.value)}
            />
          </div>
        </div>

        <div className="temakor">OKTATÁS ÉS KÉPZÉS</div> 
        <div >
        <div>
            <label htmlFor="oktidotartam">Időtartam:</label> 
            <input
              type="number"
              id="oktidotartam"
              value={oktidotartam}
              onChange={(e) => setOktIdotartam(e.target.value)}
            />
          </div>  
          <div>
            <label htmlFor="oktkezdes">Időtartam:</label> 
            <input
              type="date"
              id="oktkezdes"
              value={oktkezdes}
              onChange={(e) => setOktKezdes(e.target.value)}
            />
          </div>  
          <div>
            <label htmlFor="oktvegzes">Időtartam:</label> 
            <input
              type="date"
              id="oktvegzes"
              value={oktvegzes}
              onChange={(e) => setOktVegzes(e.target.value)}
            />
          </div>            
          <div>
          <label htmlFor="intezmeny">Oktatási képzést nyújtó szervezet neve és típusa:</label>
          <input
            type="text"
            id="intezmeny"
            value={intezmeny}
            onChange={(e) => setIntezmeny(e.target.value)}
          />
        </div>
        
          <div >
          <label htmlFor="fotargy">Érintett fő tárgyak/készségek:</label> 
          <input
              type="text"
              name="fotargy"
              value={fotargy}
              onChange={(e)=> setFotargy(e.target.value)}
            />
          </div>
          <div >
          <label htmlFor="szakkepesites">Elnyert képesítés megnevezése:</label> 
            <input
              type="text"
              name="szakkepesites"
              value={szakkepesites}
              onChange={(e)=> setSzakkepesites(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="oktszoc_keszseg">Szociális készségek és képességek:</label>
            <input
              type="text"
              id="oktszoc_keszseg"
              value={oktkeszseg}
              onChange={(e) => setOktKeszseg(e.target.value)}
            />
          </div>
        </div>
        <div className="temakor">NYELV ISMERET: </div>
        <div >
        <div>
            <label htmlFor="anyanyelv">Anyanyelv:</label> 
            <input
              type="text"
              id="anyanyelv"
              value={anyanyelv}
              onChange={(e) => setAnyanyelv(e.target.value)}
            />
          </div>       
          <div>
          <label htmlFor="nyelvtudas">Egyéb nyelvismeret:</label>
          <input
            type="text"
            id="nyelvtudas"
            value={nyelvtudas}
            onChange={(e) => setNyelvtudas(e.target.value)}
          />
        </div>
        
          <div >
          <label htmlFor="nyelvvizsga">Nylevvizsga:</label> 
            <input
              type="checkbox"
              name="nyelvvizsga"
              value={nyelvvizsga}
              onChange={(e)=> setNyelvvizsga(e.target.value)}
            />
          </div>
          <div >
          <label htmlFor="olvasas">Olvasási készség:</label> 
            <input
              type="text"
              name="olvasas"
              value={olvasas}
              onChange={(e)=> setOlvasas(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="iras">Írási készség:</label> 
            <input
              type="text"
              id="iras"
              value={iras}
              onChange={(e) => setIras(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="beszed">Beszédkészség:</label>
            <input
              type="text"
              id="beszed"
              value={beszed}
              onChange={(e) => setBeszed(e.target.value)}
            />
          </div>
        </div>
        <div className="divbotton">
        <button type="submit">Mentés</button>
        <button onClick={onGenerealas}>Önéletrajz generálás</button>
        </div>
        </form>
        </>
    );
  };
  
  export default AllaskeresoProfil;