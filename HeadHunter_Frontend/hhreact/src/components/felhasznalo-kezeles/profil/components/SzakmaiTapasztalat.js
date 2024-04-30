import { useState, useEffect } from "react";
import { putAllaskeresoTapasztalat } from "../../../../contexts/ProfilContext";
import Select from "react-select";
import { deleteAllaskerTapasztalat } from "../../../../contexts/AllaskeresoContext";

const SzakmaiTapasztalat = ({
  id,
  config,
  data,
  poziciok,
  setSzakmaiTapasztalat,
  szakmaiTapasztalat,
}) => {
  const [origCegnev, setOrigCegnev] = useState("");
  const [origPozkod, setOrigPozkod] = useState("");
  const [idotartam, setIdotartam] = useState("");
  const [kezdes, setKezdes] = useState(new Date());
  const [vegzes, setVegzes] = useState(new Date());
  const [cegnev, setCegnev] = useState("");
  const [selectedPozicio, setselectedPozicio] = useState(null);
  const [cegcim, setCegcim] = useState("");

  useEffect(() => {
    setIdotartam(data.idotartam); //backend számolja a végzés és a kezdésből.
    setCegnev(data.cegnev);
    setOrigCegnev(data.cegnev);
    setOrigPozkod(data.pozkod);
    setKezdes(data.kezdes);
    setVegzes(data.vegzes);
    setCegcim(data.ceg_cim);

    const pozObject = {
      value: data.pozkod,
      label: data.pozicio,
    };
    setselectedPozicio(pozObject);
  }, []);

  const onSubmit = (event) => {
    event.preventDefault();

    console.log(config);

    console.log("Lefut a submit.");

    putAllaskeresoTapasztalat(
      {
        cegnev,
        selectedPozicio,
        kezdes,
        vegzes,
        cegcim,
        origCegnev,
        origPozkod,
      },
      config
    ).then((response) => {
      if (response.status === 200) {
        alert("Szakmai tapasztalat elmenetve");
        setOrigCegnev(cegnev);
        setOrigPozkod(selectedPozicio.value);
        const vegzesDate = new Date(vegzes);
        const kezdesDate = new Date(kezdes);
        const yearDiff = vegzesDate.getFullYear() - kezdesDate.getFullYear();
        const monthDiff = vegzesDate.getMonth() - kezdesDate.getMonth();
        setIdotartam(yearDiff * 12 + monthDiff);
      } else {
        alert(`Hiba a szakmai tapasztalat mentésekor ${response.data.message}`);
      }
    });
  };

  const torles = () => {
    const tapasztalatok = szakmaiTapasztalat
      .filter((item) => item.id !== id)
      .map((item, index) => {
        return {
          ...item,
          id: `szakmaitap__${index}`,
        };
      });
    setSzakmaiTapasztalat(tapasztalatok);

    console.log("megfut most a törlés:");
    deleteAllaskerTapasztalat(origCegnev, origPozkod, config);
  };

  return (
    <form id={id} key={id} onSubmit={onSubmit}>
      <div className="temakor">
        SZAKMAI TAPASZTALAT
        <div>
          <label htmlFor="idotartam">Időtartam: {idotartam ?? 0} hónap</label>
        </div>
        <div>
          <label htmlFor="kezdes">Kezdés dátuma:</label>
          <input
            type="date"
            id="kezdes"
            value={kezdes}
            onChange={(e) => setKezdes(e.target.value)}
          />
        </div>
        <div>
          <label htmlFor="vegzes">Végzés dátuma:</label>
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
        <div>
          <label htmlFor="cegcim">Munkáltató címe:</label>
          <input
            type="text"
            id="cegcim"
            value={cegcim}
            onChange={(e) => setCegcim(e.target.value)}
          />
        </div>
        <div>
          <label htmlFor="terulet">Tevékenység típusa és ágazata:</label>
        </div>
        <div>
          <label htmlFor="pozicio">Foglalkoztatás, beosztás:</label>
          <Select
            className="react-select"
            options={poziciok}
            value={selectedPozicio}
            onChange={setselectedPozicio}
          />
        </div>
        <div className="temakor-buttons">
          <button className="mentes" type="submit">
            Mentés
          </button>
        </div>
        <div className="temakor-buttons">
          <button className="torles" onClick={torles}>
            Törlés
          </button>
        </div>
      </div>
    </form>
  );
};

export default SzakmaiTapasztalat;
