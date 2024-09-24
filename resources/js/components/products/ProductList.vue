<template>
    <div class="relative overflow-x-auto bg-white">
        <table class="w-full text-sm text-left text-slate-500 ">
            <thead class="text-xs text-slate-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">Imagen</th>
                    <th scope="col" class="px-6 py-3">SKU</th>
                    <th scope="col" class="px-6 py-3">Categoría</th>
                    <th scope="col" class="px-6 py-3">Descripción</th>
                    <th scope="col" class="px-6 py-3">Precio por mayor</th>
                    <th scope="col" class="px-6 py-3">Precio por menor</th>
                    <th scope="col" class="px-6 py-3">Precio distribuidor</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <slot></slot>
            </tbody>
        </table>
    </div>
</template>
<script></script>
