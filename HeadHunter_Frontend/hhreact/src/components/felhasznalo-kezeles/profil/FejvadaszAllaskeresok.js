import Alert from 'react-bootstrap/Alert';
import React from "react";

export default function FejvadaszAllaskeresok(props){

    let ds = props.dataService;
    const [users, setUsers] = useState([]);
    const [error, setError] = useState("");
  
    useEffect(() => {
      ds.getData("allaskeresos", (status, response) => {
        console.log(status, response);
        if (status === 200) {
          setError("");
          setUsers(response);
        } else {
          setUsers([]);
          setError(response.message);
        }
      });
    }, [ds]);
  
    return (
      <article>
        <h2>Álálskereső  kártyák</h2>
  
        {error && <Alert variant={"danger"}>{error}</Alert>}
  
        <div className="row gap-2">
          {users && users?.map((a, i) => (
            <UserCard key={i} allasker={a} />
          ))}
        </div>
      </article>
    );
  }
  
  function UserCard(prop) {
    let allasker = prop.allasker;
    return (
      <div className="col-sm-3">
        <div className="card shadow-sm">
          <div className="card-body">
            <img
              src={`https://i.pravatar.cc/300?img=` + user.id}
              alt="avatar"
              style={{ width: "100%" }}
            />
            <h5 className="card-title">{allasker.nev}</h5>
            <div className="card-text">
              <div className="container">
                <div className="row">
                  <div className="col-12">
                    <b>Neme:</b>
                  </div>
                  <div className="col-12">{allasker.nem}</div>
                </div>
                <div className="row">
                  <div className="col-12">
                    <b>Születési idő:</b>
                  </div>
                  <div className="col-12">{allasker.szul_ido}</div>
                  <div className="col-12">
                    <b>Lakcím:</b>
                  </div>
                  <div className="col-12">{allasker.cim}</div>
                  <div className="col-12">
                    <b>Telefonszám:</b>
                  </div>
                  <div className="col-12">{allasker.telefonszam}</div>
                  <div className="col-12">
                    <b>Fax:</b>
                  </div>
                  <div className="col-12">{allasker.fax}</div>
                  <div className="col-12">
                    <b>Anyanyelv:</b>
                  </div>
                  <div className="col-12">{allasker.anyanyelv}</div>
                  <div className="col-12">
                    <b>Állampolgárság:</b>
                  </div>
                  <div className="col-12">{allasker.allampolgarsag}</div>
                  <div className="col-12">
                    <b>Vezetői engedély:</b>
                  </div>
                  <div className="col-12">{allasker.jogositvany}</div>
                  <div className="col-12">
                    <b>Szociális készség:</b>
                  </div>
                  <div className="col-12">{allasker.szoc_keszseg}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
}