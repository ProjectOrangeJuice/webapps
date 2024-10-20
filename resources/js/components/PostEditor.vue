<template>
    
<div>

    <h1>Edit post</h1>

    <div>
        <h3>Title</h3>
        <input type="text" class="form-control" name="title">
        <h4>Tags</h4>
        <div class="input-group mb-3">
            <input type="text" class="form-control">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Add</button>
            </div>
        </div>
        <div>(foreach tag)</div>
        <h4>Content</h4>
        <textarea class="form-control" rows=10></textarea>
        <h4>Images</h4>
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="exampleFormControlFile1">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Add</button>
            </div>
        </div>

        (foreach image)


    </div>
    <button class="btn btn-success form-control">Save</button>
    <hr>
    <button class="btn btn-danger form-control">Delete</button>
</div>

</template>


<script>
export default {}
</script>