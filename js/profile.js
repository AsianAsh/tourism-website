const image = document.querySelector("#cropBox")

    const fileInput = document.querySelector(".fileInput")
    const uploadPicBtn = document.querySelector(".uploadPicBtn")
    const resetImageBtn = document.querySelector(".fileInputResetBtn")
    const removePicBtn = document.querySelector(".removePicBtn")
    const imageForm = document.querySelector(".imageForm")
    const outerCropWrapper = document.querySelector(".outer-crop-wrapper")
    const userProfilePicture = document.querySelector(".userProfilePicture")

    if (userProfilePicture.src !== userProfilePicture.baseURI && userProfilePicture.src.includes(
            "/svg/profile-pic-default.svg") === false) {
        removePicBtn.classList.remove("hidden")
    }

    // Initialised the Cropper object
    const imageCrop = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 2,

        preview: ".preview",

        minCropBoxWidth: 550,
        minCropBoxHeight: 550,

        minContainerHeight: 550,
        minContainerWidth: 550,

        minCanvasWidth: 550,
        minCanvasHeight: 550
    })

    // Destroy the Cropper object
    resetImageBtn.addEventListener("click", function() {
        uploadPicBtn.classList.add("hidden")
        imageCrop.destroy()

    })

    fileInput.addEventListener("change", function(e) {
        const imageCrop = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 2,

            preview: ".preview",

            minCropBoxWidth: 550,
            minCropBoxHeight: 550,

            minContainerHeight: 550,
            minContainerWidth: 550,

            minCanvasWidth: 550,
            minCanvasHeight: 550
        })
        const result = getImageURL(this)

        if (e.target.value) {
            uploadPicBtn.classList.remove("hidden")
        }
    })

    const inputImageErrorMessage = document.createElement("small")
    inputImageErrorMessage.innerHTML = "Only images are allowed"
    inputImageErrorMessage.classList.add("d-block")

    // Get the crop image as Canvas type
    uploadPicBtn.addEventListener("click", function() {
        const cropImage = imageCrop.getCroppedCanvas({
            width: 200,
            height: 200,
            fillColor: '#fff',
            imageSmoothingEnabled: false,
            imageSmoothingQuality: 'low',
        })
        
        // Check if the data is valid
        if (!cropImage) {

            if (outerCropWrapper.contains(inputImageErrorMessage) === false) {
                outerCropWrapper.appendChild(inputImageErrorMessage)
            }

        } else {
            // Convert Canvas into dataURI
            // An input element with type text is created to be appended to the form with the value being the dataURI
            const finalImage = cropImage.toDataURL();
            const inputWithImageData = document.createElement("input")
            inputWithImageData.type = "hidden"
            inputWithImageData.name = "newProfilePic"
            inputWithImageData.setAttribute("value", finalImage)
            imageForm.appendChild(inputWithImageData)
            imageForm.submit()
        }
    })

    // Get the url of the image that was selected by the user from the Choose File button
    function getImageURL(input) {
        const reader = new FileReader()
        reader.addEventListener("load", function(e) {
            imageCrop.replace(e.target.result)
        })
        if (input) {
            reader.readAsDataURL(input.files[0])
        }
    }