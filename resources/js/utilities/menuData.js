const menuData = {
    clientsMenu: [
        {
            name: "Nuevo cliente",
            url: "/clients/create"
        },
        {
            name: "Catalago clientes",
            url: "/clients"
        }
    ],
    ExpensesMenu: [
        {
            name: "Nuevo egreso",
            url: "/expenses/create"
        },
        {
            name: "Todos los egresos",
            url: "/expenses"
        }
    ],
    InventoryMenu: [
        {
            name: "Nuevo inventario",
            url: "/inventories/create"
        },
        {
            name: "Catalago almacenes",
            url: "/warehouses"
        },
        {
            name: "Existencias",
            url: "/inventories"
        },
        {
            name: "Nueva categoría",
            url: "/categories"
        },
        {
            name: "Nuevo producto",
            url: "/products/create"
        },
        {
            name: "Comprar productos",
            url: "/products/?queryType=toBuy"
        },
        {
            name: "Editar productos",
            url: "/products/?queryType=list"
        }
    ],
    ExpressMenu: [
        {
            name: "Venta",
            url: "/fast-sales/create"
        },
        {
            name: "Bonificaciones",
            url: "/product-bonuses"
        }
    ],
    RaffleMenu: [
        {
            name: "Crear Rifa",
            url: "/raffles/create"
        },
        {
            name: "Lista de rifas",
            url: "/raffles"
        },
        {
            name: "Boletos de rifa ",
            url: "/raffle-numbers"
        },
        {
            name: "Asignar boleto",
            url: "/raffle-assignaments/assign-by-saleable/create"
        },
        {
            name: "Ayuda de rifas",
            url: "/documentacion/rifas"
        },
    ],
    ReportsMenu: [
        {
            name: "Reporte General",
            url: "/general-report/"
        },
        {
            name: "Ventas",
            url: "/sales/"
        },
        {
            name: "Venta Expres",
            url: "/fast-sales"
        },
        {
            name: "Compras",
            url: "/purchases"
        },
        {
            name: "Comisiones",
            url: "/user-commissions"
        },
        {
            name: "Pagos",
            url: "/payments"
        },
        {
            name: "Egresos",
            url: "/expense-report"
        }
    ],
    ConfigMenu: [
        {
            name: "Nuevo usuario",
            url: "/register/"
        },
        {
            name: "Modificar usuario",
            url: "/users"
        },
        {
            name: "Nuevo rol",
            url: "/roles/create"
        },
        {
            name: "Contenido del ticket",
            url: "/tickets/1/edit"
        },
        {
            name: "Datos adicionales",
            url: "/settings"
        }
    ],
    CreditsMenu: [
        {
            name: "Catálago Créditos",
            url: "/credits",
        }
    ],

}


module.exports = menuData;
