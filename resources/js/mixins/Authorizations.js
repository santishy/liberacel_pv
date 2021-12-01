const { mapGetters, mapState, mapActions } = require("vuex");

module.exports = 
{
    
    computed:{
        ...mapState(['auth','user']),
        ...mapGetters(['isAdmin','getCurrentUser'])
    }
}