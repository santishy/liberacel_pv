<template>
    <div class="shadow-sm bg-white ">
        <table class="table-auto w-full">
            <thead class="bg-blue-700 ">
                <tr class=" text-white font-extralight">
                    <th class="px-1 py-2">Imagen</th>
                    <th class="px-1 py-2">SKU</th>
                    <th class="px-1 py-2">Categoría</th>
                    <th class="px-1 py-2">Descripción</th>
                    <th class="px-1 py-2">Precio por mayor</th>
                    <th class="px-1 py-2">Precio por menor</th>
                    <th class="px-1 py-2">Precio distribuidor</th>
                    <th class="px-1 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <slot></slot>
            </tbody>
        </table>
    </div>
</template>
<script></script>