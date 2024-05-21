let imagesForUpload = []
const maxFilesQuantity = 5
const types = ['image/jpeg', 'image/png']

const dragAndDrop = document.querySelector('#drag-and-drop'),
    imagesList = document.querySelector('#images-list'),
    uploadBtn = document.querySelector('#upload-btn'),
    uploadForm = document.querySelector('#upload-form'),
    dropzone = document.querySelector('#dropzone-file')

uploadBtn.setAttribute('disabled', true)

dragAndDrop.addEventListener('dragenter', (e) => e.preventDefault())
dragAndDrop.addEventListener('dragleave', (e) => e.preventDefault())
dragAndDrop.addEventListener('dragover', (e) => e.preventDefault())

dragAndDrop.addEventListener('drop', (e) => {
    e.preventDefault()
    const files = e.dataTransfer.files
    addFiles(files)
    if (
        imagesForUpload.length > 0 &&
        imagesForUpload.length <= maxFilesQuantity
    ) {
        uploadBtn.removeAttribute('disabled')
    }
})

dropzone.addEventListener('change', () => {
    const files = new FormData(uploadForm).getAll('dropzone-file')
    dropzone.value = ''
    addFiles(files)
    if (
        imagesForUpload.length > 0 &&
        imagesForUpload.length <= maxFilesQuantity
    ) {
        uploadBtn.removeAttribute('disabled')
    }
})

function addFiles(files) {
    for (let key in files) {
        if (
            types.includes(files[key].type) &&
            imagesForUpload.length < maxFilesQuantity
        ) {
            imagesForUpload.push(files[key])
            let imageTmpUrl = URL.createObjectURL(files[key])
            imagesList.innerHTML += `<img src="${imageTmpUrl}" class="images-list-picture h-32 w-32 rounded-lg" alt="">`
        }
    }
}

uploadForm.addEventListener('submit', (event) => {
    event.preventDefault()
    const formData = new FormData(uploadForm)
    formData.delete('dropzone-file')
    imagesForUpload.forEach((image) => {
        formData.append('images[]', image)
    })
    const requestURL = '/load_images'
    const options = {
        method: 'POST',
        body: formData,
    }
    fetch(requestURL, options).then(() => (window.location += 'gallery'))
})
