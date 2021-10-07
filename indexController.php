<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use DElfimov\GDImage\GDImage;

class ResizeController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('resize/index.html.twig');
    }

    /**
     * @Route("/resize", name="resize")
     */
    public function resize(Request $request): void
    {
        // GET THE IMAGE REQUEST
        $file = $request->files->get('img');
        //Install GdImage Package then Call (DElfimov\GDImage\GDImage)
        $image = new GDImage($file);
        //SET A COLOR TO THE BLANK SPACE
        $image->setFillColor([255, 255, 255]);
        //RESIZING THE IMAGE (NEW HEIGHT & NEW WIDTH)
        $image->resize(720, 480);
        //GET THE FOLDER IMAGE DIRECTORY (PUT IT ON THE SERVICES.YAML)
        $uploading_imgs = $this->getParameter('uploading_imgs_directory');
        //GET THE IMAGE EXTENSION
        $extension = $image->getImageType();
        // SET A RANDOME FILENAME + FILE EXTENSION
        $filename = mt_rand(1200,5000000). '.' . $extension;
        //SAVING THE IMAGE ON IMG FOLDER
        $image->save($uploading_imgs.'/'.$filename);

        dump('good');die;//OR dd('good')
    }
}
