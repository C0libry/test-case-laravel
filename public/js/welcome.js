let imagesForUpload = []

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
    if (imagesForUpload.length > 0 && imagesForUpload.length < 5) {
        uploadBtn.removeAttribute('disabled')
    }
})

dropzone.addEventListener('change', () => {
    console.log
    const files = new FormData(uploadForm).getAll('dropzone-file')
    console.log(files)
    dropzone.value = ''
    addFiles(files)
    if (imagesForUpload.length > 0 && imagesForUpload.length < 5) {
        uploadBtn.removeAttribute('disabled')
    }
})

function addFiles(files) {
    for (let key in files) {
        if (types.includes(files[key].type) && imagesForUpload.length < 5) {
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
