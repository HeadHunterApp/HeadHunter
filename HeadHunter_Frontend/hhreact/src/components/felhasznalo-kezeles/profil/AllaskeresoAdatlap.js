import { useState, useEffect } from "react";
import SzemelyesAdatokRO from "./components/SzemelyesAdatokRO";
import NyelvismeretRO from "./components/NyelvismeretRO";
import OktatasKepzesRO from "./components/OktatasKepzesRO";
import SzakmaiTapasztalatRO from "./components/SzakmaiTapasztalatRO";
import { useParams } from "react-router-dom";
import {
  getAllaskerNyelvtudasById,
  getAllaskerTanulmanyById,
  getAllaskerTapasztalatById,
  getAllaskeresoById,
} from "../../../contexts/AllaskeresoContext";
import VisszaLink from "../../menu/VisszaLink";

const AllaskeresoAdatlap = () => {
  const { user_id } = useParams();

  const [szemelyesInfok, setSzemelyesInfok] = useState({});
  const [nyelvek, setNyelvek] = useState([]);
  const [tapasztalatok, setTapasztalatok] = useState([]);
  const [tanulmanyok, setTanulmanyok] = useState([]);

  //személy id alapján kéri le a személy személyes adatait
  useEffect(() => {
    getAllaskeresoById(user_id).then((response) => {
      let adat = response.data;

      setSzemelyesInfok(adat);
      console.log(adat.fenykep);
    });

    //személy id alapján kéri le a személy nyelvtudásait
    getAllaskerNyelvtudasById(user_id).then((response) => {
      setNyelvek(
        response.data.map((item, index) => {
          return {
            id: `nyelv__${index}`,
            ...item,
          };
        })
      );
    });

    //személy id alapján kéri le a személy tanulmányait
    getAllaskerTanulmanyById(user_id).then((response) => {
      setTanulmanyok(
        response.data.map((item, index) => {
          return {
            id: `tanulmany__${index}`,
            ...item,
          };
        })
      );
    });

    //személy id alapján kéri le a személy szakmai tapasztalatait
    getAllaskerTapasztalatById(user_id).then((response) => {
      setTapasztalatok(
        response.data.map((item, index) => {
          return {
            id: `szakmaitap__${index}`,
            ...item,
          };
        })
      );
    });
  }, []);

  return (
    <div className="allprofil">
      <div>
        <SzemelyesAdatokRO adatok={szemelyesInfok} />

        {nyelvek.map((item, index) => (
          <NyelvismeretRO key={index} adatok={item} />
        ))}

        {tanulmanyok.map((item, index) => (
          <OktatasKepzesRO key={index} adatok={item} />
        ))}

        {tapasztalatok.map((item, index) => (
          <SzakmaiTapasztalatRO key={index} adatok={item} />
        ))}
      </div>
      <VisszaLink />
    </div>
  );
};

export default AllaskeresoAdatlap;
