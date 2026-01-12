import { createElement } from './utils/createElement'

import './styles/app.scss'
const button = document.querySelector('#add-element')
const target = document.querySelector('#add-zone')

button.addEventListener('click', () => {
    createElement(target)
});