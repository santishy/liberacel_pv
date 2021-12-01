const getProducts = ({ context }, page) => {
    return new Promise((resolve, reject) => {
        axios.get('/products', {
            params: {
                page: page
            }
        })
            .then((res) => {
                resolve(res)
            })
            .catch((err) => {
                reject(err)
            })
    });
}
const search = ({ context }, params) => {
    return new Promise((resolve, reject) => {
        axios.get('/searching-products', {
            params
        })
            .then((res) => {
                resolve(res);
            })
            .catch((err) => {
                reject(err);
            })
    })
} 
/* const search = ({ context }, data) => {
    return new Promise((resolve, reject) => {
        axios.get('/searching-products', {
            params: {
                'filter[search]': data.sku,
                page: data.page
            }
        })
            .then((res) => {
                resolve(res);
            })
            .catch((err) => {
                reject(err);
            })
    })
} */
/*const getUser = async ({ commit }) => {
    const user = await axios.get('/current-user')
    commit('SET_USER', user.data.data);

}*/
export default {
    getProducts,
    search,
   // getUser
}