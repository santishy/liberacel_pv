module.exports = {
    methods: {
        notify({ type = 'sucess', title, message }) {

            this.$notify({
                group: "foo",
                title: title,
                text: message,
                type: type 
            });
        }
    }
}