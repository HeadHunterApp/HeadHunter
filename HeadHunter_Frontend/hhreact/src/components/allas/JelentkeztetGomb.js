import React, { useEffect, useState } from "react";
import Select from "react-select";
import axios from "../../api/axios";
import { postAllasJelentkezo } from "../../contexts/AllasContext";
import { getAllaskeresoAll } from "../../contexts/AllaskeresoContext";

export default function JelentkeztetGomb(props) {
  const [config, setConfig] = useState("");
  const allas_id = props.allas_id;
  const [kivalasztas, setKivalasztas] = useState(false);
  const [allaskerOptions, setAllaskerOptions] = useState([]);
  const [selectedAllasker, setSelectedAllasker] = useState(null);
  const [allaskereso, setAllaskereso] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      let token = "";

      await axios.get("/api/token").then((response) => {
        console.log(response);
        token = response.data;
      });

      console.log("------------TOKEN--------------");
      console.log(token);

      const config = {
        headers: {
          "X-CSRF-TOKEN": token,
        },
      };
      setConfig(config);
    };

    fetchData();
  }, []);

  const handleKivalasztas = () => {
    setKivalasztas(true);
    getAllaskeresoAll().then((response) => {
      const osszesAllasker = response.data.map((allasker) => {
        return {
          value: allasker.user_id,
          label: `${allasker.user_id} - ${allasker.nev}`,
        };
      });
      setAllaskerOptions(osszesAllasker);
    });
  };

  const handleOtherApply = async (e) => {
    e.preventDefault();
    try {
      setAllaskereso(selectedAllasker.value);
      console.log("config: ");
      console.log(config);
      console.log("allas_id: ");
      console.log(allas_id);
      console.log("allaskereso user_id: ");
      console.log(allaskereso);
      await postAllasJelentkezo(allas_id, allaskereso, config);
      alert("Sikeres jelentkeztetés!");
    } catch (error) {
      console.error(error);
      alert("Hiba történt a jelentkeztetés során");
    }
  };

  return (
    <>
      <button type="choose" onClick={handleKivalasztas}>
        Álláskereső kiválasztása
      </button>
      {kivalasztas && (
        <>
          <Select
            options={allaskerOptions}
            onChange={(selectedOption) => setSelectedAllasker(selectedOption)}
            value={selectedAllasker}
            placeholder="Válassz egy álláskeresőt..."
          />
          <button type="button" onClick={handleOtherApply}>
            Jelentkeztetés
          </button>
        </>
      )}
    </>
  );
}
