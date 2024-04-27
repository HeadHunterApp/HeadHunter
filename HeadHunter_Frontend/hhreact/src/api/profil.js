import axios from "../api/axios";

export const getProfilAdmin = (user_id)=>
    axios.get(`/api/admin/user/${user_id}`)

export const getProfilFejvadasz = ()=>
    axios.get(`/api/hunter/headhunters/profile/v2`)

export const putProfilFejvadász = (params, config) =>
    axios.put('/api/hunter/headhunters/profile/modification/v2', params, config);

export const postFotoFeltolt = (formData, token)=>
    //axios.post("/api/hunter/headhunters/profile/image", formData, { headers:{ "Content-Type": "multipart/form-data", "X-CSRF-TOKEN": token}})
    axios.post("/api/user/profile/image", formData, { headers:{ "Content-Type": "multipart/form-data", "X-CSRF-TOKEN": token}})

export const getProfilAllaskereso = ()=> 
    axios.get(`/api/seeker/jobseekers/profile/v2`);

export const putProfilAllakereso = (params, config) =>
    axios.put('/api/seeker/jobseekers/profile/modification/v2', params, config);

export const getAllaskeresoTapasztalat = ()=>
    axios.get('/api/seeker/jobseekers/profile/exps/v2');

export const putAllaskeresoTapasztalat = (params, config) =>
    axios.put('/api/seeker/jobseekers/profile/exps/modification/v2', params, config);

export const getAllaskeresoTanulmany = ()=>
    axios.get('/api/seeker/jobseekers/profile/edu-atts/v2');

export const putAllaskeresoTanulmany = (params, config)=>
    axios.put('/api/seeker/jobseekers/profile/edu-atts/modification/v2', params, config);

export const getAllaskeresoNyelvtudas = ()=>
    axios.get('/api/seeker/jobseekers/profile/languages/v2');

export const putAllaskeresoNyelvtudas = (params, config) =>
    axios.put('/api/seeker/jobseekers/profile/languages/modification/v2', params, config);

export const getFejvadaszAllaskereso = (params, config) =>
    axios.get('api/hunter/jobseekers/all');
