let carrito = [];

function agregarAlCarrito(productoId) {
    carrito.push(productoId);
    console.log("Producto agregado al carrito:", productoId);
}

function mostrarCarrito() {
    if (carrito.length === 0) {
        console.log("El carrito está vacío");
    } else {
        console.log("Productos en el carrito:", carrito);
    }
}
