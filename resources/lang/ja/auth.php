<?php

return [
    'failed' => 'ログイン情報が登録されていません。',
    // その他のメッセージ
];

// 不親切ですが、セキュリティを考慮すると、この方が望ましいといえます。

// もし、出し分けを行っていた場合、適当なメールアドレスや他人のメールアドレスでログインしようとして、パスワードが間違っています、と表示されると、

// そのメールアドレスはこのWebサービスにユーザー登録はされており、あとはパスワードさえわかればログインできること
// その適当なメールアドレスは誰かの実在するメールアドレスと考えられること
// そのメールアドレスの保有者がこのWebサービスを利用していること
// などがわかってしまい、悪意のあるユーザーに余計な情報を与えることになります。

// ログイン失敗時のメッセージを詳細に出し分けると、このようなデメリットもあるということを知識として覚えておいてください。