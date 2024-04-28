import { useEffect, useState } from "react";
import Select from "react-select";
import { putAllaskeresoNyelvtudas } from "../../../../api/profil";

const Nyelvismeret = ({ id, config, data, nyelvek }) => {
  const [nyelvvizsga, setNyelvvizsga] = useState(false);
  const [origNyelvTudas, setOrigNyelvTudas] = useState("");
  const [olvasas, setOlvasas] = useState("");
  const [iras, setIras] = useState("");
  const [beszed, setBeszed] = useState("");
  const [selectedNyelv, setSelectedNyelv] = useState("");

  useEffect(() => {
    setOrigNyelvTudas(data.nyelvtudas);
    setNyelvvizsga(data.nyelvvizsga);
    setOlvasas(data.olvasas);
    setIras(data.iras);
    setBeszed(data.beszed);

    const nyelvObject = {
      value: data.nyelvtudas,
      label: data.nyelv + ' - ' + data.szint
    }
    setSelectedNyelv(nyelvObject);
  }, []);

  const onSubmit = (event) => {
    event.preventDefault();

    putAllaskeresoNyelvtudas(
      { nyelvvizsga, olvasas, iras, beszed, selectedNyelv, origNyelvTudas },
      config
    ).then((response) => {
      if (response.status === 200) {
        alert("Nyelvtudas elmenetve");
        setOrigNyelvTudas(selectedNyelv.value);
      } else {
        alert(`Hiba a Nyelvtudas mentésekor ${response.data.message}`);
      }
    });
  };

  return (
    <form id={id} key={id} onSubmit={onSubmit}>
      <div className="temakor">
        NYELV ISMERET:
        <div>
          <div>
            <label htmlFor="nyelvtudas">Idegen nyelvismeret:</label>
            <Select className="react-select" options={nyelvek} value={selectedNyelv} onChange={setSelectedNyelv}/>
          </div>
          <div>
            <label htmlFor="nyelvvizsga">Nylevvizsga:</label>
            <input
              type="checkbox"
              name="nyelvvizsga"
              value={nyelvvizsga}
              checked={nyelvvizsga}
              onChange={(e) => setNyelvvizsga(e.target.checked)}
            />
          </div>
          <div hidden={!nyelvvizsga}>
            <label htmlFor="olvasas">Olvasási készség:</label>
            <input
              type="text"
              name="olvasas"
              value={olvasas}
              onChange={(e) => setOlvasas(e.target.value)}
            />
          </div>
          <div hidden={!nyelvvizsga}>
            <label htmlFor="iras">Írási készség:</label>
            <input
              type="text"
              id="iras"
              value={iras}
              onChange={(e) => setIras(e.target.value)}
            />
          </div>
          <div hidden={!nyelvvizsga}>
            <label htmlFor="beszed">Beszédkészség:</label>
            <input
              type="text"
              id="beszed"
              value={beszed}
              onChange={(e) => setBeszed(e.target.value)}
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

export default Nyelvismeret;
