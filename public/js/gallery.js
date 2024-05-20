const params = new URLSearchParams(document.location.search)
const sort = params.get('sort')

document.querySelector('#sort-selector').addEventListener('change', () => {
    document.querySelector('#sort-form').submit()
})

const targetOption = document.querySelector(`option[value='${sort}']`)

if (targetOption) targetOption.setAttribute('selected', true)
