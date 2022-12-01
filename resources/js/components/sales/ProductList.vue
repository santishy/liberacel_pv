<template>
    <table class="w-full table-auto text-sm text-center text-gray-500 dark:text-gray-400">
        <thead class="text-xs font-mono border-b-2 border-gray-100 text-gray-700 uppercase  dark:text-gray-400">
            <tr>
                <th class="py-3 px-6">Imagen</th>
                <th class="py-3 px-6">SKU</th>
                <th class="py-3 px-6">Descripción</th>
                <th class="py-3 px-6">Cantidad</th>
                <th class="py-3 px-6">Precio</th>
                <th class="py-3 px-6">Importe</th>
                <th class="py-3 px-6">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <slot></slot>
        </tbody>
    </table>
</template>
