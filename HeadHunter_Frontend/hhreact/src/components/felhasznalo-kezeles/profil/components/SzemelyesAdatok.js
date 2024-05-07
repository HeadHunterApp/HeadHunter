import { useState, useEffect } from "react";
import {
  getProfilAllaskereso,
  putProfilAllakereso,
  postFotoFeltolt,
} from "../../../../contexts/ProfilContext";
const SzemelyesAdatok = ({ id, config, token }) => {
  const [nev, setNev] = useState("");
  const [email, setEmail] = useState("");
  const [telefonszam, setTelefonszam] = useState("");
  const [fax, setFax] = useState("");
  const [allampolgarsag, setAllampolgarsag] = useState("");
  const [szul_ido, setSzul_ido] = useState("2005-01-01");
  const [jogositvany, setJogositvany] = useState(false);
  const [keszseg, setKeszseg] = useState("");
  const [neme, setNeme] = useState("");
  const [cim, setCim] = useState("");
  const [anyanyelv, setAnyanyelv] = useState("");

  const [imageSrc, setImageSrc] = useState(null);

  // álláskeresőnek betölti a személyes adatait szerkeszthető módban
  useEffect(() => {
    getProfilAllaskereso().then((response) => {
      let adat = response.data;
      setNev(adat.nev);
      setEmail(adat.email);
      setTelefonszam(adat.telefonszam);
      setFax(adat.fax);
      setAllampolgarsag(adat.allampolgarsag);
      setSzul_ido(adat.szul_ido);
      setJogositvany(adat.jogositvany);
      setKeszseg(adat.keszseg);
      setNeme(adat.neme);
      setCim(adat.cim);
      setAnyanyelv(adat.anyanyelv);

      if(adat.fenykep){
        const decodedImage = 'data:image/png;base64,' + response.data.fenykep;
        setImageSrc(decodedImage);
      }
    });
  }, []);

  const onSubmit = (event) => {
    event.preventDefault();

    //elmenti / frissíti az álláskereső adatait
    putProfilAllakereso(
      {
        nev,
        email,
        telefonszam,
        fax,
        allampolgarsag,
        szul_ido,
        jogositvany,
        keszseg,
        neme,
        cim,
        anyanyelv,
      },
      config
    ).then((response) => {
      if (response.status === 200) {
        alert("Profil elmenetve");
      } else {
        alert(`Hiba a profil mentésekor ${response.data.message}`);
      }
    });
  };

  //feltölti az álláskereső fényképét, és lementi a szerverre
  const fenykepFeltoltes = async (event) => {
    event.preventDefault();

    const fajl = event.target.files[0];

    setImageSrc(URL.createObjectURL(fajl));

    let formData = new FormData();
    formData.append("image", fajl);

    postFotoFeltolt(formData, token);
  };

  return (
    <form id={id} key={id} onSubmit={onSubmit}>
      <div>
        <label htmlFor="fenykep">Fénykép:</label>
        <div style={{ display: "flex" }}>
          {imageSrc && <img className="photo" src={imageSrc} />}
          <div>
            <input type="file" id="fenykep" onChange={fenykepFeltoltes} />
          </div>
        </div>
      </div>
      <div className="temakor">
        SZEMÉLYES ADATOK:
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
            <label htmlFor="anyanyelv">Anyanyelv:</label>
            <input
              type="text"
              id="anyanyelv"
              value={anyanyelv}
              onChange={(e) => setAnyanyelv(e.target.value)}
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
          <div>
            <label>Fax:</label>
            <input
              type="text"
              name="fax"
              value={fax}
              onChange={(e) => setFax(e.target.value)}
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
          <div>
            <label>Állampolgárság:</label>
            <input
              type="text"
              name="allampolgarsag"
              value={allampolgarsag}
              onChange={(e) => setAllampolgarsag(e.target.value)}
            />
          </div>
          <div>
            <label>Születési idő:</label>
            <input
              type="date"
              name="szul_ido"
              value={szul_ido}
              onChange={(e) => setSzul_ido(e.target.value)}
            />
          </div>
          <div>
            <div className="nem">
              <label className="nem-label1"> Férfi</label>
              <input
                type="radio"
                value="férfi"
                checked={neme === "férfi"}
                name="nem"
                onChange={(e) => setNeme(e.target.value)}
              />
            </div>
            <div className="nem">
              <label className="nem-label">Nő</label>
              <input
                type="radio"
                value="nő"
                checked={neme === "nő"}
                name="nem"
                onChange={(e) => setNeme(e.target.value)}
              />
            </div>
          </div>
          <div>
            <label>Vezetői engedély(ek):</label>
            <input
              type="checkbox"
              name="jogositvany"
              value={jogositvany}
              checked={jogositvany}
              onChange={(e) => setJogositvany(e.target.checked)}
            />
          </div>
          <div>
            <label>Betölteni kívánt munkakör/foglalkozási terület:</label>
            <input
              type="text"
              name="szoc_keszseg"
              value={keszseg}
              onChange={(e) => setKeszseg(e.target.value)}
            />
          </div>
        </div>
        <button className="mentes" type="submit">
          Mentés
        </button>
      </div>
    </form>
  );
};

export default SzemelyesAdatok;
