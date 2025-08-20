function changeQty(id, delta) {
    const input = document.querySelector(`input[name='qty[${id}]']`);
    let value = parseInt(input.value) + delta;
    if (value < 0) value = 0;
    input.value = value;
}
