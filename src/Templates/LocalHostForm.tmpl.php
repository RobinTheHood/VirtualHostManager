<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Virtual Host Manager</title>

        <!-- Bootstrap style CDN -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1 class="py-4">Virtual Host Manager</h1>

            <a class="btn btn-outline-secondary" href="/" role="button">Back to Overview</a>
            <div class="py-4">

            <form action="" method="post">
                <div class="form-group">
                    <label for="localHost">Virtual Local Host</label>
                    <input type="text" class="form-control" name="localHost" id="localHost" placeholder="example.local" value="<?php echo $selectedVirtualHost->getLocalHost() ?>">
                </div>

                <div class="form-group">
                    <label for="remoteHost">Remote Host</label>
                    <input type="text" class="form-control" name="remoteHost" id="remoteHost" placeholder="example.com" value="<?php echo $selectedVirtualHost->getRemoteHost() ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Example Website"
                    value="<?php echo $selectedVirtualHost->getDescription() ?>" >
                </div>

                <div class="form-group">
                    <label for="documentsRootPath">DocumentsRoot</label>
                    <input type="text" class="form-control" name="documentsRootPath" id="documentsRootPath" placeholder="/var/www/example-httpdocs" value="<?php echo $selectedVirtualHost->getDocumentsRootPath() ?>">
                </div>

                <button type="submit" class="btn btn-primary">Save Settings</button>

                <?php if ($selectedVirtualHost->getId()) { ?>
                    <a href="?method=deleteEntry&id=<?php echo $selectedVirtualHost->getId(); ?>" class="btn btn-danger float-right">Delete Entry</a>
                <?php } ?>

            </form>
        </div>

        <!-- Bootstrap scripts CDN -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


        <script>
        $(document).ready(function () {
            $("form").submit(function (e) {
                //stop submitting the form to see the disabled button effect
                //e.preventDefault();
                //disable the submit button
                $(":submit").attr("disabled", true);
                $(":submit").html("Please wait ...");
                return true;
            });
        });
        </script>
    </body>
</html>
