<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Virtual Host Manager</title>

        <!-- Bootstrap style CDN -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Fontawesome style CDN -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1 class="py-4">Virtual Host Manager</h1>

            <a class="btn btn-outline-primary" href="?method=addLocalHost" role="button">Add Virtual Local Host ...</a>
            <a class="btn btn-outline-secondary" href="?method=reconfigure" role="button">Update Config ...</a>

            <div class="py-4">

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Local Host</th>
                        <th scope="col">Remote Host</th>
                        <th scope="col">Description</th>
                        <th scope="col" class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $count = 0; ?>
                    <?php foreach ($virtualHosts as $virtualHost) { ?>
                        <tr>
                            <th scope="row"><?php echo ++$count;?></th>
                            <td>
                                <?php if (!$virtualHost->documentsRootExists()) { ?>
                                    <i style="color: red" class="fas fa-exclamation-triangle"></i>
                                <?php } ?>
                                <a target="_blank" href="http://<?php echo $virtualHost->getLocalHost() ?>"><?php echo $virtualHost->getLocalHost() ?></a>
                            </td>
                            <td><a target="_blank" href="http://<?php echo $virtualHost->getRemoteHost() ?>"><?php echo $virtualHost->getRemoteHost() ?></a></td>
                            <td><?php echo $virtualHost->getDescription() ?></td>
                            <td class="text-right"><a href="?method=editLocalHost&id=<?php echo $virtualHost->getId() ?>" class="btn btn-outline-primary btn-sm" href="?method=addLocalHost" role="button">Edit</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Bootstrap scripts CDN -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
