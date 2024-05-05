import axios from "../api/axios";

//mindenki eléri

//shortAllasAll
export const getAllasAll = ()=>
    axios.get('/api/jobs-basic/all');
//detailedAllas
export const getAllas = (allas_id)=>
    axios.get(`/api/jobs-basic/${allas_id}`);

//detailedAllasIsm
export const getAllasIsmeret = (allas_id)=>
    axios.get(`/api/jobs-basic/${allas_id}/skills`);
//detailedAllasNyelv
export const getAllasNyelvtudas = (allas_id)=>
    axios.get(`/api/jobs-basic/${allas_id}/languages`);
//detailedAllasVegz
export const getAllasVegzettseg = (allas_id)=>
    axios.get(`/api/jobs-basic/${allas_id}/edu-atts`);
//detailedAllasTap
export const getAllasTapasztalat = (allas_id)=>
    axios.get(`/api/jobs-basic/${allas_id}/exps`);


//új és szerkesztés - fejvadász és admin

//allas   
export const postAllas = (params)=>
    axios.post(`/api/jobs/new`, params);

export const putAllas = (allas_id, params)=>
    axios.put(`/api/jobs/modification/${allas_id}`, params);

//allas-ismeret    
export const postAllaskerIsmeret = (params)=>
    axios.post(`/api/jobs/skills/new`, params);
    
export const putAllaskerIsmeret = (allas_id, params)=>
    axios.put(`/api/jobs/${allas_id}/skills/modification`, params);

//allas-nyelvtudas
export const postAllaskerNyelvtudas = (params)=>
    axios.post(`/api/jobs/languages/new`, params);
    
export const putAllaskerNyelvtudas = (allas_id, params)=>
    axios.put(`/api/jobs/${allas_id}/languages/modification`, params);

//allas-vegzettseg
export const postAllasVegzettseg = (params)=>
    axios.post(`/api/jobs/edu-atts/new`, params);
    
export const putAllasVegzettseg = (allas_id, params)=>
    axios.put(`/api/jobs/${allas_id}/edu-atts/modification`, params);
    
//allas-tapasztalat    
export const postAllasTapasztalat = (params)=>
    axios.post(`/api/jobs/exps/new`, params);

export const putAllasTapasztalat = (allas_id, params)=>
    axios.put(`/api/jobs/${allas_id}/exps/modification`, params);

//allas-jelentkezo

export const getAllasJelentkezoAll = ()=>
    axios.get(`/api/jobs/applicants-all`);

export const getAllasJelentkezok = (allas_id)=>
    axios.get(`/api/jobs/${allas_id}/applicants`);

//allaskereso maga jelentkezik:
export const postAllaskerJelentkezes = (allas_id, config)=>
    axios.post(`/api/jobseekers/jobs/${allas_id}/apply`, [], config);

//fejvadasz/admin jelentkeztet allaskeresot:
export const postAllasJelentkezo = (allas_id, allaskereso, config)=>
    axios.post(`/api/jobs/applicants/new`, {allas: allas_id, allaskereso: allaskereso}, config);

export const putAllasJelentkezo = (allas_id, params)=>
    axios.put(`/api/jobs/${allas_id}/applicants/modification`, params);



//csak az alap táblaadatok megjelenítése, id-k által meghívott adatok nélkül:
//index
export const getAllasAllRaw = ()=>
axios.get('/api/jobs-all');
//show
export const getAllasRaw = (allas_id)=>
axios.get(`/api/jobs/${allas_id}`);

//detailedAllasIsm
export const getAllasIsmeretRaw = (allas_id)=>
axios.get(`/api/jobs/${allas_id}/skills`);
//detailedAllasNyelv
export const getAllasNyelvtudasRaw = (allas_id)=>
axios.get(`/api/jobs/${allas_id}/languages`);
//detailedAllasVegz
export const getAllasVegzettsegRaw = (allas_id)=>
axios.get(`/api/jobs/${allas_id}/edu-atts`);
//detailedAllasTap
export const getAllasTapasztalatRaw = (allas_id)=>
axios.get(`/api/jobs/${allas_id}/exps`);
