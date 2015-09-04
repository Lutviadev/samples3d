<?php

namespace App\Http\Controllers;

use App\Animation;
use App\Briefcase;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Image;
use App\Maincategory;
use App\Profile;
use App\Render;
use App\Subcategory;
use App\Tour;
use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use PDO;

class MigratorController extends Controller
{

    public function users()
    {
        $role = Role::find(4)->toArray();

        define('ESQUEMA','samplesoldest');
        define('ESQUEMAU','root');
        define('ESQUEMAP','lutviadev');

        $pdo = new PDO('mysql:host=localhost;dbname='.ESQUEMA, ESQUEMAU, ESQUEMAP);
        $pdo-> exec("SET CHARACTER SET utf8");

        $consulta= $pdo->prepare('SELECT user, email, password, name, lastname, phone, facebook, twitter, linkedin, web, address, company, companyphone, companymail FROM usuario');
        $consulta->execute();

        $consulta->bindColumn(1, $username);
        $consulta->bindColumn(2, $email);
        $consulta->bindColumn(3, $password);
        $consulta->bindColumn(4, $firstname);
        $consulta->bindColumn(5, $lastname);
        $consulta->bindColumn(6, $phone);
        $consulta->bindColumn(7, $facebook);
        $consulta->bindColumn(8, $twitter);
        $consulta->bindColumn(9, $linkedin);
        $consulta->bindColumn(10, $web);
        $consulta->bindColumn(11, $address);
        $consulta->bindColumn(12, $company);
        $consulta->bindColumn(13, $companyphone);
        $consulta->bindColumn(14, $companymail);

        while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC))
        {
            if($email == '')
            {
                $email = $username.'@'.$username.'.com';
            }

            $user = User::create(['username' => $username, 'email' => $email, 'password' => bcrypt($password)]);

            $profile = Profile::create([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'phone' => $phone,
                'facebook' => $facebook,
                'twitter' => $twitter,
                'linkedin' => $linkedin,
                'web' => $web,
                'company' => $company,
                'companyaddress' => $address,
                'companymail' => $companymail,
                'companyphone' => $companyphone
                ]);

            $user->attachRole($role['id']);
            $user->profile()->save($profile);
        }

        echo 'Users Migrated';
    }

    public function animations()
    {
        $briefcase = Briefcase::find(1);
        $case[0] = $briefcase->id;

        define('ESQUEMA','samplesoldest');
        define('ESQUEMAU','root');
        define('ESQUEMAP','lutviadev');

        $pdo = new PDO('mysql:host=localhost;dbname='.ESQUEMA, ESQUEMAU, ESQUEMAP);
        $pdo-> exec("SET CHARACTER SET utf8");

        $consulta= $pdo->prepare('SELECT title, keywords, vimeo FROM animation WHERE idAnimation != 1');
        $consulta->execute();

        $consulta->bindColumn(1, $title);
        $consulta->bindColumn(2, $keywords);
        $consulta->bindColumn(3, $vimeo);

        while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC))
        {
            $animArr = [
                'title' => $title,
                'vimeo' => $vimeo
            ];

            $anim = Animation::create($animArr);

            $image = Image::create(['name'=>'','description'=>'','path'=>'storage/animationcovers/'.$vimeo.'.jpg']);

            $anim->images()->attach($image);

            $anim->briefcases()->attach($case);

            $cleantags = [];

            $tagsArr = explode(',', $keywords);

            foreach ($tagsArr as $tag)
            {
                $cleantags[] = trim($tag);
            }

            manageTags($cleantags, $anim, 'create');

        }

        echo 'Animations Migrated';
    }

    public function tours()
    {
        $briefcase = Briefcase::find(1);
        $case[0] = $briefcase->id;

        define('ESQUEMA','samplesoldest');
        define('ESQUEMAU','root');
        define('ESQUEMAP','lutviadev');

        $pdo = new PDO('mysql:host=localhost;dbname='.ESQUEMA, ESQUEMAU, ESQUEMAP);
        $pdo-> exec("SET CHARACTER SET utf8");

        $consulta= $pdo->prepare('SELECT title, keywords, foldername FROM tour WHERE idTour != 1');
        $consulta->execute();

        $consulta->bindColumn(1, $title);
        $consulta->bindColumn(2, $keywords);
        $consulta->bindColumn(3, $foldername);

        while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC))
        {
            $tourArr = [
                'title' => $title,
                'foldername' => $foldername
            ];

            $tour = Tour::create($tourArr);

            $tour->briefcases()->attach($case);

            $cleantags = [];

            $tagsArr = explode(',', $keywords);

            foreach ($tagsArr as $tag)
            {
                $cleantags[] = trim($tag);
            }

            manageTags($cleantags, $tour, 'create');

        }

        echo 'Tours Migrated';
    }

    public function renders()
    {
        $briefcase = Briefcase::find(1);
        $case[0] = $briefcase->id;

        define('ESQUEMA','samplesoldest');
        define('ESQUEMAU','root');
        define('ESQUEMAP','lutviadev');

        $pdo = new PDO('mysql:host=localhost;dbname='.ESQUEMA, ESQUEMAU, ESQUEMAP);
        $pdo-> exec("SET CHARACTER SET utf8");

        $consulta= $pdo->prepare('
            SELECT rubro.name as main, categoria.name as cat, subcategoria.name as subcat, image.titlen , image.intext as env, image.idImage as oldid
            FROM image, rubro, categoria, subcategoria
            WHERE image.idRubro = rubro.idRubro AND image.idCategoria = categoria.idCategoria AND image.idSubcategoria = subcategoria.idSubcategoria
        ');
        $consulta->execute();

        $consulta->bindColumn(1, $main);
        $consulta->bindColumn(2, $cat);
        $consulta->bindColumn(3, $subcat);
        $consulta->bindColumn(4, $title);
        $consulta->bindColumn(5, $env);
        $consulta->bindColumn(6, $oldid);

        while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC))
        {
            $main = Maincategory::where('name', $main)->first();

            $cat = Category::where('name', $cat)->first();

            $subcat = Subcategory::where('name', $subcat)->first();

            $envi = $env == 0 ? 'exterior' : 'interior';

            $renderArr = [
                'maincategory_id' => $main->id,
                'category_id' => $cat->id,
                'subcategory_id' => $subcat->id,
                'name' => $title,
                'enviroment' => $envi
            ];

            $render = Render::create($renderArr);

            $render->briefcases()->attach($case);

            $gallery= $pdo->prepare('SELECT idGaleria FROM galeria WHERE idMaster = ? AND idSeccion = 2 LIMIT 1');
            $gallery->execute(array($oldid));
            $gallery->bindColumn(1, $idGaleria);

            while ($resgallery = $gallery->fetch(PDO::FETCH_ASSOC))
            {
                $imgids = [];

                $img = [];

                $tagsArr = [];

                $imagenes= $pdo->prepare('SELECT title, description, keywords, name, mimetype FROM imagenc WHERE idGaleria = ?');
                $imagenes->execute(array($idGaleria));

                $imagenes->bindColumn(1, $title);
                $imagenes->bindColumn(2, $description);
                $imagenes->bindColumn(3, $keywords);
                $imagenes->bindColumn(4, $name);
                $imagenes->bindColumn(5, $mimetype);

                while ($resimagenes = $imagenes->fetch(PDO::FETCH_ASSOC))
                {
                    $img = [
                        'title' => $title,
                        'description' => preg_replace( "/\r|\n/", "", $description),
                        'path' => 'storage/renders/'.$name.'.'.$mimetype
                    ];

                    $cleantags = [];

                    $tagsArr = explode(',', $keywords);

                    foreach ($tagsArr as $tag)
                    {
                        $cleantags[] = trim($tag);
                    }

                    $image = Image::create($img);

                    manageTags($cleantags, $image, 'create');

                    $imgids[] = $image->id;
                }

                $render->images()->attach($imgids);
            }

        }

        echo 'Renders Migrated';
    }

}