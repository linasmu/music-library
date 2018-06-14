<?php
    class Song {
        private $con;
        private $id;
        private $mysqliData;
        private $title;
        private $artistId;
        private $albumId;
        private $genre;
        private $duration;
        private $link;

        public function __construct($con, $id) {
            $this->con = $con;
            $this->id = $id;
        }

        public function getName() {
            $query = mysqli_query($this->con, "SELECT songs FROM artists WHERE id='$this->id'");
            $this->mysqliData = mysqli_fetch_array($query);
            $this->title = $this->mysqliData['title'];
            $this->artistId = $this->mysqliData['artist'];
            $this->albumId = $this->mysqliData['album'];
            $this->genre = $this->mysqliData['genre'];
            $this->diration = $this->mysqliData['duration'];
            $this->link = $this->mysqliData['link'];

        }

        public function getTitle() {
            return $this->title;
        }

        public function getArtist() {
            return new Artist($this->con, $this->artistId);
        }

        public function getAlbum() {
            return new Album($this->con, $this->albumId);
        }

        public function getGenre() {
            return $this->genre;
        }

        public function getLink() {
            return $this->link;
        }

        public function getDuration() {
            return $this->duration;
        }

        public function getMysqliData() {
            return $this->mysqliData;
        }
    }

?>