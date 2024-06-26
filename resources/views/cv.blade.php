@extends('layout')

@section('title', 'Home')
@section('description', "Brief curriculum of Sébastien L'haire")
@section('content')
<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="col">
        <p><img src="/img/seb.png"/></p>
      </div>
      <div class="col">
        <h2>Dr. Sébastien L'HAIRE</h2>
        <h4>Développeur web - Ingénieur QA - Ingénieur en Traitement du Langage</h4>
        <p>21 Balcon de l'Aire<br />
        F - 74160 Saint-Julien-en-Genevois<br />
        <strong>Tel&nbsp;:</strong> ++41 78 773 66 48<br/>
        <a href="mailto:sebastien@lhaire.org">sebastien@lhaire.org</a>
        </p>
        <p>Né le 28 avril 1972.<br />
        Marié<br />
        Nationalité suisse</p>
      </div>
    </div>
  </div>
</div>
<h3><a href="docs/cv.pdf" target="_blank" rel="noopener noreferrer">CV détaillé</a> -
  <a href="docs/resume_en.pdf" target="_blank" rel="noopener noreferrer">Resumé in English</a></h3>
<h3 class="scto">Compétences-clé:</h3>
<p>Excellentes connaissances en réalisation de sites Internet. Bonne expérience en ingénierie des langues. Méticuleux, soucieux de la qualité du travail rendu. Autonome.</p>
<h3 class="scto">Diplômes:</h3>
<ul>
	<li><strong>Thèse de doctorat en linguistique,</strong> Université de Genève, Faculté des Lettres. Titre: <a href="http://archive-ouverte.unige.ch/unige:16552" rel="noopener noreferrer" target="_blank">&laquo;Traitement Automatique des Langues et Apprentissage des Langues Assisté par Ordinateur : bilan,
    résultats et perspectives&raquo;</a>, mention très  honorable <a rel="noopener noreferrer" target="_blank" href="docs/publications/these.pdf">pdf</a>
    <a target="_blank" href="docs/publications/soutenanceV2.pdf" rel="noopener noreferrer">présentation de soutenance</a></li>
<li><strong>Diplôme d'études Supérieures </strong>&laquo;Génie Linguistique&raquo;, Faculté des Lettres.</li>
<li> <strong>Diplôme d'Etudes Approfondies </strong> &laquo;Information Scientifique et Technique&raquo;, Université de Marne-la-Vallée. </li>
<li><strong>Licence ès Lettres, </strong>de l'Université de Genève, Grec ancien, Histoire de l'Antiquité et Informatique.</li>
</ul>
<h3 class="scto">Langues:</h3>
<ul>
<li>français&nbsp;: langue maternelle, excellentes capacités rédactionnelles. </li>
<li>anglais&nbsp;: niveau moyen/ avancé. </li>
<li>allemand&nbsp;: lu, parlé, écrit (niveau maturité) </li>
</ul>
<h3 class="scto">Compétences informatiques:</h3>
<ul>
<li><strong>Technologies de l'information et de la communication:</strong> PHP. Framework: Laravel. CMS: Wordpress. Développement Frontend:
Angular, jQuery. Virtualisation: Docker, Kubernetes.</li>
<li><strong>Publication Assistée par Ordinateur: </strong>bases en Xpress, Pagemaker, Indesing. Niveau moyen en traitement d'images (Photoshop, Gimp). </li>
<li><strong>Programmation:</strong> Pascal, Modula 2, Pascal Objet, Component Pascal. Bases en C, C++, Java,  Perl</li>
<li><strong>Administration systèmes:</strong> Windows, Windows Server, Linux (tâches de base) </li>
<li><strong>Learning Management Systems: </strong>WebCt, Dokeos (niveau tuteur), Moodle etc. </li>
<li><strong>Traitement automatique des langues:</strong> analyse, correction orthographique, structures sémantiques. </li>
</ul>
<h3  class="scto">Divers:</h3>
<ul><li><a href="publis/">Publications scientifiques</a></li>
</ul>
@endsection
