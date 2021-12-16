<template>
    <form @submit.prevent="submit" class="px-2 py-4">
        <div class="mb-0 px-2">
            <input
                name="email"
                class="
                    border-2
                    placeholder-gray-600
                    bg-gray-100
                    rounded
                    relative
                    rounded-bl-none rounded-br-none
                    appearance-none
                    w-full
                    py-3
                    px-3
                    text-gray-700
                    leading-tight
                    focus:outline-none
                    focus:ring-indigo-500
                    focus:border-indigo-500
                    focus:z-10
                "
                id="email"
                v-model="form.email"
                type="email"
                placeholder="Email..."
            />
        </div>
        <div class="mb-0 px-2">
            <input
                name="password"
                class="
                    border-2
                    placeholder-gray-600
                    bg-gray-100
                    relative
                    appearance-none
                    rounded rounded-tl-none rounded-tr-none
                    w-full
                    py-3
                    px-3
                    text-gray-700
                    leading-tight
                    focus:outline-none
                    focus:ring-indigo-500
                    focus:border-indigo-500
                    focus:z-10
                "
                id="password"
                type="password"
                v-model="form.password"
                placeholder="Contraseña..."
            />
        </div>
        <div>
            <button type="submit" class="">Enviar</button>
        </div>
    </form>
</template>
<script>
export default {
    props: {
        model: {
            type: String,
        },
        id: {
            type: Number,
        },
    },
    data() {
        return {
            form: {},
        };
    },
    methods: {
        async submit() {
            try {
                this.form.model = this.model;
                this.form.id = this.id;
                const res = await axios.post("/user-relationship", this.form);
            } catch (err) {
                console.log(err);
            }
        },
    },
};
</script>
