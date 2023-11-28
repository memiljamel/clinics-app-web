const inputAvatarList = [].slice.call(
  document.querySelectorAll('input[name="avatar"]')
);

const imgAvatarList = [].slice.call(
  document.querySelectorAll('[data-te-container="avatar"]')
);

const fileTypes = [
  'image/apng',
  'image/bmp',
  'image/gif',
  'image/jpeg',
  'image/pjpeg',
  'image/png',
  'image/svg+xml',
  'image/tiff',
  'image/webp',
  'image/x-icon',
];

function validFileType(file) {
  return fileTypes.includes(file.type);
}

inputAvatarList.map((inputAvatarItem, index) => {
  inputAvatarItem.addEventListener('change', () => {
    const currentFiles = inputAvatarItem.files;

    if (currentFiles.length > 0) {
      const file = currentFiles[0];
      imgAvatarList[index].src = validFileType(file)
        ? URL.createObjectURL(file)
        : imgAvatarList[index].src;
    }
  });
});
