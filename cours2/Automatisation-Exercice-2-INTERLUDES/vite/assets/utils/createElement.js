export function createElement(target) {
    const element = document.createElement('div');
    element.textContent = 'Un element';
    element.classList.add('element');
    target.appendChild(element);
}