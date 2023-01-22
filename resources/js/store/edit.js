document.addEventListener('alpine:init', () => {
    Alpine.data('inventoryEdit', () => ({
        serverData,
        serverImages: [],
        uploadImageProgress: {},
        maxImageCount: 4,
        get maxImage() {
            return this.serverImages.length + serverData.image.length < this.maxImageCount
        },
        async storeImage(el) {
            const files = el.files

            if (!files[0].type.startsWith('image')) {
                Swal.fire({
                    icon: 'error',
                    title: 'The file must be image',
                    text: 'Something went wrong!',
                })

                return;
            }

            const image = await this.compressImage(files[0], {
                // 0: is maximum compression
                // 1: is no compression
                quality: 0.5,

                // We want a JPEG file
                type: files[0].type,
            });

            const fileReader = new FileReader();
            const serverImages = this.serverImages;

            fileReader.onload = (e) => {
                const formData = new FormData()
                formData.append('image', image, files[0].name)
                axios.post('/image/pre-upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: progressEvent => {
                        const { loaded, total } = progressEvent;
                        let percent = Math.floor((loaded * 100) / total);
                        if (percent < 100) {
                            this.uploadImageProgress.percent = percent;
                            if (!this.uploadImageProgress.url) this.uploadImageProgress.url = e.target.result
                        }
                    }
                })
                    .then(res => {
                        this.uploadImageProgress = {};
                        serverImages.push({ id: res.data.id, url: e.target.result })
                    })
                    .catch(error => {
                        this.uploadImageProgress = {};
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'Something went wrong!',
                        })
                        console.error(error);
                    })
            }

            fileReader.readAsDataURL(image);
        },

        createElement(element, config) {
            const el = document.createElement(element);
            Object.entries(config).forEach(function ([key, value]) {
                el.setAttribute(key, value)
            })

            return el;
        },

        removeDataImage(id) {
            this.$refs[`image-${id}`].remove();
            const input = this.createElement('input', {
                type: 'hidden',
                value: id,
                name: 'deleteImageIds[]'
            })
            document.getElementById('editInventoryForm').appendChild(input)
        }
        ,
        async compressImage(file, { quality = 1, type = file.type }) {
            // Get as image data
            const imageBitmap = await createImageBitmap(file);

            // Draw to canvas
            const canvas = document.createElement('canvas');
            canvas.width = imageBitmap.width;
            canvas.height = imageBitmap.height;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(imageBitmap, 0, 0);

            // Turn into Blob
            return await new Promise((resolve) =>
                canvas.toBlob(resolve, type, quality)
            );
        }
    }))
})