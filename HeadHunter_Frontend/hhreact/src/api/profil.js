import axios from "../api/axios";
/*ilyen nincs, törölni kéne
export const getProfilAdmin = (user_id)=>
    axios.get(`/api/admin/user/${user_id}`)
*/
export const getProfilFejvadasz = ()=>
    axios.get(`/api/headhunters/profile`)

export const putProfilFejvadász = (params, config) =>
    axios.put('/api/headhunters/profile/modification', params, config);

export const postFotoFeltolt = (formData, token)=>
    axios.post("/api/headhunters/profile/image", formData, { headers:{ "Content-Type": "multipart/form-data", "X-CSRF-TOKEN": token}})

export const getProfilAllaskereso = ()=> 
    axios.get(`/api/jobseekers/profile`);

export const putProfilAllakereso = (params, config) =>
    axios.put('/api/jobseekers/profile/modification', params, config);

export const getAllaskeresoTapasztalat = ()=>
    axios.get('/api/jobseekers/profile/exps');

export const putAllaskeresoTapasztalat = (params, config) =>
    axios.put('/api/jobseekers/profile/exps/modification', params, config);

export const getAllaskeresoTanulmany = ()=>
    axios.get('/api/jobseekers/profile/edu-atts');

export const putAllaskeresoTanulmany = (params, config)=>
    axios.put('/api/jobseekers/profile/edu-atts/modification', params, config);

export const getAllaskeresoNyelvtudas = ()=>
    axios.get('/api/jobseekers/profile/languages');

export const putAllaskeresoNyelvtudas = (params, config) =>
    axios.put('/api/jobseekers/profile/languages/modification', params, config);



