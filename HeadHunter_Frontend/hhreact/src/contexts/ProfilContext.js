import axios from "../api/axios";
/*ilyen nincs, törölni kéne
export const getProfilAdmin = (user_id)=>
    axios.get(`/api/admin/user/${user_id}`)
*/
/* export const getProfilFejvadasz = ()=>
    axios.get(`/api/headhunters/profile`) */

export const getProfilFejvadasz = ()=>
    axios.get(`/api/headhunters/profile/v2`)

/* export const putProfilFejvadász = (params, config) =>
    axios.put('/api/headhunters/profile/modification', params, config); */

export const putProfilFejvadász = (params, config) =>
    axios.put('/api/headhunters/profile/modification/v2', params, config);

//beraktam azért a területes route-ot is,hátha mégis használnánk
export const getFejvadaszTerulet = ()=>
    axios.get(`/api/headhunters/profile/fields`)

export const postFotoFeltolt = (formData, token)=>
    axios.post("/api/user/profile/image", formData, { headers:{ "Content-Type": "multipart/form-data", "X-CSRF-TOKEN": token}})

/* export const getProfilAllaskereso = ()=> 
    axios.get(`/api/jobseekers/profile`); */

 export const getProfilAllaskereso = ()=> 
    axios.get(`/api/jobseekers/profile/v2`);

/* export const putProfilAllaskereso = (params, config) =>
    axios.put('/api/jobseekers/profile/modification', params, config); */

export const putProfilAllakereso = (params, config) =>
    axios.put('/api/jobseekers/profile/modification/v2', params, config);

/* export const getAllaskeresoTapasztalat = ()=>
    axios.get('/api/jobseekers/profile/exps'); */

export const getAllaskeresoTapasztalat = ()=>
    axios.get('/api/jobseekers/profile/exps/v2');

/* export const putAllaskeresoTapasztalat = (params, config) =>
    axios.put('/api/jobseekers/profile/exps/modification', params, config); */

export const putAllaskeresoTapasztalat = (params, config) =>
    axios.put('/api/jobseekers/profile/exps/modification/v2', params, config);

/* export const getAllaskeresoTanulmany = ()=>
    axios.get('/api/jobseekers/profile/edu-atts'); */

export const getAllaskeresoTanulmany = ()=>
    axios.get('/api/jobseekers/profile/edu-atts/v2');

/* export const putAllaskeresoTanulmany = (params, config)=>
    axios.put('/api/jobseekers/profile/edu-atts/modification', params, config); */

export const putAllaskeresoTanulmany = (params, config)=>
    axios.put('/api/jobseekers/profile/edu-atts/modification/v2', params, config);

/* export const getAllaskeresoNyelvtudas = ()=>
    axios.get('/api/jobseekers/profile/languages'); */

export const getAllaskeresoNyelvtudas = ()=>
    axios.get('/api/jobseekers/profile/languages/v2');

/* export const putAllaskeresoNyelvtudas = (params, config) =>
    axios.put('/api/jobseekers/profile/languages/modification', params, config); */

export const putAllaskeresoNyelvtudas = (params, config) =>
    axios.put('/api/jobseekers/profile/languages/modification/v2', params, config);

export const getAllaskeresoJelentkezett = ()=>
    axios.get(`/api/jobseekers/profile/applications`);
