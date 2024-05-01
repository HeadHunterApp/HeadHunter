import { useState, useEffect } from "react";
import { putAllaskeresoTanulmany } from "../../../../contexts/ProfilContext";
import Select from "react-select";
import { deleteAllaskerTanulmany } from "../../../../contexts/AllaskeresoContext";

const OktatasKepzes = ({
  id,
  config,
  data,
  vegzettsegek,
  setTanulmany,
  tanulmany,
}) => {
  const [oktkezdes, setOktKezdes] = useState(new Date());
  const [oktvegzes, setOktVegzes] = useState(new Date());
  const [intezmeny, setIntezmeny] = useState("");
  const [origIntezmeny, setOrigIntezmeny] = useState("");
  const [fotargy, setFotargy] = useState("");
  const [szakkepesites, setSzakkepesites] = useState("");
  const [origSzakkepesites, setOrigSzakkepesites] = useState("");
  const [selectedVegzettseg, setSelectedVegzettseg] = useState("");
  const [oktidotartam, setOktIdotartam] = useState(null);

  useEffect(() => {
    console.log(vegzettsegek);
    if (data) {
      //TODO: --> nem ez volt a baj a felületen. Több oktatás esetén elhasal valami.
      setOrigIntezmeny(data.intezmeny);
      setOrigSzakkepesites(data.szak);
      setOktIdotartam(data.idotartam);
      setOktKezdes(data.kezdes);
      setOktVegzes(data.vegzes);
      setIntezmeny(data.intezmeny);
      setFotargy(data.erintett_targytev);
      setSzakkepesites(data.szak);

      console.log(data.vegzettseg);
      console.log("------ mappelés:");
      const vegzettsegData = {
        value: data.vegzettseg.id,
        label: data.vegzettseg.megnevezes,
      };

      setSelectedVegzettseg(vegzettsegData);
    }
  }, []);

  const onSubmit = (event) => {
    event.preventDefault();

    putAllaskeresoTanulmany(
      {
        intezmeny,
        fotargy,
        szakkepesites,
        oktkezdes,
        oktvegzes,
        selectedVegzettseg,
        origIntezmeny,
        origSzakkepesites,
      },
      config
    ).then((response) => {
      console.log(response.status);
      if (response.status === 200) {
        alert("Tanulmany elmenetve");
        setOrigIntezmeny(intezmeny);
        setOrigSzakkepesites(szakkepesites);
      } else {
        alert(`Hiba a Tanulmany mentésekor ${response.data.message}`);
      }
    });
  };

  const torles = () => {
    const tanulmanyok = tanulmany
      .filter((item) => item.id !== id)
      .map((item, index) => {
        return {
          ...item,
          id: `oktkepzes__${index}`,
        };
      });
    setTanulmany(tanulmanyok);

    deleteAllaskerTanulmany(origIntezmeny, origSzakkepesites, config);
  };

  return (
    <div className="temakor">
      <form id={id} key={id} onSubmit={onSubmit}>
        OKTATÁS ÉS KÉPZÉS
        <div>
          <div>
            <label htmlFor="oktidotartam">
              Időtartam: {oktidotartam ?? 0} hónap
            </label>
          </div>
          <div>
            <label htmlFor="oktkezdes">Kezdés dátuma:</label>
            <input
              type="date"
              id="oktkezdes"
              value={oktkezdes}
              onChange={(e) => setOktKezdes(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="oktvegzes">Végzés dátuma:</label>
            <input
              type="date"
              id="oktvegzes"
              value={oktvegzes}
              onChange={(e) => setOktVegzes(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="intezmeny">
              Oktatási képzést nyújtó Intézmény:
            </label>
            <input
              type="text"
              id="intezmeny"
              value={intezmeny}
              onChange={(e) => setIntezmeny(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="szakkepesites">Szak:</label>
            <input
              type="text"
              id="szakkepesites"
              value={szakkepesites}
              onChange={(e) => setSzakkepesites(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="fotargy">Érintett fő tárgyak:</label>
            <input
              type="text"
              name="fotargy"
              value={fotargy}
              onChange={(e) => setFotargy(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="vegzettseg">Végzettség:</label>
            <Select
              className="react-select"
              options={vegzettsegek}
              value={selectedVegzettseg}
              onChange={setSelectedVegzettseg}
            />
          </div>
          {/*           <div>
            <label htmlFor="oktszoc_keszseg">
              Szociális készségek és képességek:
            </label>
            <input
              type="text"
              id="oktszoc_keszseg"
              value={oktkeszseg}
              onChange={(e) => setOktKeszseg(e.target.value)}
            />
          </div> */}
        </div>
        <div className="temakor-buttons">
          <button className="mentes" type="submit">
            Mentés
          </button>
        </div>
      </form>
      <div className="temakor-buttons">
        <button className="torles" onClick={torles}>
          Törlés
        </button>
      </div>
    </div>
  );
};

export default OktatasKepzes;
