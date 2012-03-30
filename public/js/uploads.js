var Uploads = {
    files:{},
    getFileExt:function(filename)
    {
        var names = filename.split('.');
        return names[names.length-1];
    },
    getFileName:function(filename)
    {
        var ext = this.getFileExt(filename);
        return filename.replace('.'+ext, '');
    },
    add:function(filename)
    {
        this.files[filename] = filename;
    },

}